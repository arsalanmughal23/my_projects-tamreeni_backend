<?php

namespace App\Http\Controllers;

use App\Constants\NotificationServiceTemplateNames;
use App\Models\Appointment;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\UserMembership;
use Flash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Response;

class PayTabsController extends AppBaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $payTabsProfileId;
    private $payTabsServerKey;
    private $payTabsServerUrl;

    const Authorized = 'A';
    const Hold = 'H';
    const Pending = 'P';
    const Voided = 'V';
    const Error = 'E';
    const Declined = 'D';
    const Expired = 'X';

    public function __construct() {
        $this->payTabsProfileId = config('constants.paytabs.PAYTABS_PROFILE_ID');
        $this->payTabsServerKey = config('constants.paytabs.PAYTABS_SERVER_KEY');
        $this->payTabsServerUrl = config('constants.paytabs.PAYTABS_SERVER_URL');
    }

    function create_payment_page()
    {
        $fields   = [
            "profile_id"       => $this->payTabsProfileId,
            "tran_type"        => "sale",
            "tran_class"       => "ecom",//ecom | recurring
            "cart_id"          => "Bsaray Sample Payment",
            "cart_description" => "Dummy Order 35925502061445345",
            "cart_currency"    => "SAR",
            "cart_amount"      => 46.17,
            // "callback"         => "https://webhook.site/bb3f3bc8-ab44-443a-9d9f-f718c9adbd24",
            "callback"         => url('/paytabs-callback'),
            "return"           => url('/paytabs-return'),
            "tokenize"         => "2", //for tokenized transaction
            // "customer_details" => [
            //     "name"    => "John Smith",
            //     "email"   => "jsmith@gmail.com",
            //     "street1" => "404, 11th st, void",
            //     "city"    => "dubai",
            //     "country" => "AE",
            //     "ip"      => "94.204.129.89"
            // ],
            // "shipping_details" => [
            //     "name"    => "name1 last1",
            //     "email"   => "email1@domain.com",
            //     "phone"   => "971555555555",
            //     "street1" => "street2",
            //     "city"    => "dubai",
            //     "state"   => "dubai",
            //     "country" => "AE",
            //     "zip"     => "54321",
            //     "ip"      => "2.2.2.2"
            // ],
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => $this->payTabsServerKey,
            'Content-type'  => 'application/json'
        ])->post($this->payTabsServerUrl, $fields);

        return $response->json();

    }

    function query_transaction(Request $request)
    {
        $fields   = [
            "profile_id" => $this->payTabsProfileId,
            'tran_ref'   => $request->input('tran_ref') // example
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => $this->payTabsServerKey,
            'Content-type'  => 'application/json'
        ])->post('https://secure.paytabs.sa/payment/query', $fields);

        return $response->json();
    }

    public function createTransaction($data)
    {
        $fields   = [
            "profile_id"       => $this->payTabsProfileId,
            "tran_type"        => "sale",
            "tran_class"       => $data['tran_class'],//ecom | recurring
            "cart_id"          => $data['cart_id'],
            "cart_description" => $data['description'],
            "cart_currency"    => $data['currency'],
            "cart_amount"      => $data['amount'],
            // "callback"         => "https://webhook.site/bb3f3bc8-ab44-443a-9d9f-f718c9adbd24",
            // "return"           => "https://webhook.site/bb3f3bc8-ab44-443a-9d9f-f718c9adbd24",
            "callback"         => url('/paytabs-callback'),
            "return"           => url('/paytabs-return'),
            "tokenize"         => $data['tokenize'], //for tokenized transaction
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => $this->payTabsServerKey,
            'Content-type'  => 'application/json'
        ])->post($this->payTabsServerUrl, $fields);

        return $response->json();
    }

    public function callBackFunction(Request $request)
    {
        try{
            DB::beginTransaction();
            $transaction = Transaction::where(['payment_charge_id' => $request->tran_ref, 'status' => Transaction::STATUS_HOLD])
                                ->orderBy('created_at', 'desc')->first();

            if(!$transaction)
                throw new \Error('Transaction is not found, Webhook Payload is: '.json_encode($request->all()));

            $transactionable = $transaction?->transactionable;
            $user = $transactionable?->user;

            if ($request->payment_result['response_status'] == Transaction::PAY_TABS_SUCCESS_STATUS) {
                $transaction->update(['status' => Transaction::STATUS_COMPLETE]);

                if($transactionable instanceof UserMembership) {
                    $transactionable->paymentSuccess();

                    if ($user) {
                        $user->update(['is_trail_available' => false]);
                        $notificationType = NotificationServiceTemplateNames::PAYMENT;

                        $message = [
                            __('payment.notification.message', ['moduleName' => 'User Membership'], 'en'),
                            __('payment.notification.message', ['moduleName' => 'User Membership'], 'ar')
                        ];

                        $title = [
                            __('payment.notification.title', ['moduleName' => 'User Membership'], 'en'),
                            __('payment.notification.title', ['moduleName' => 'User Membership'], 'ar')
                        ];

                        sendNotification($user, $notificationType, $transaction->id, $title, $message);
                    }
                } else {
                    $transaction->appointments()->update(['payment_status' => Appointment::PAYMENT_STATUS_PAID]);
                }

            } else {
                $transaction->update(['status' => Transaction::STATUS_CANCEL]);

                if($transactionable instanceof UserMembership) {
                    $transactionable->paymentReject();
                } else {
                    $transaction->appointments()->update(['payment_status' => Appointment::PAYMENT_STATUS_REJECT]);
                }
            }
            DB::commit();
            return $this->sendResponse(null, 'Weebhook Success');
        } catch (\Error $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage(), 403);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage(), 422);
        }

    }

    public function payTabs_return(Request $request)
    {
        // request-payload:
        // {
        //     "acquirerMessage": null,
        //     "acquirerRRN": null,
        //     "cartId": "35",
        //     "customerEmail": "test@yopmail.com",
        //     "respCode": "G38393",
        //     "respMessage": "Authorised",
        //     "respStatus": "A",
        //     "signature": "544dc80168a6861defcd36db4bbb6229516dd65539dbab899e2d40e8c0c19db6",
        //     "token": null,
        //     "tranRef": "TST2421300915609"
        // }

        $data = $request->all();
        if (!isset($data['respStatus']))
            return $this->sendError('Response data missing', 422);

        $transactionReturnViewName = match ($data['respStatus']) {
            self::Authorized => 'payment_success',
            default => 'payment_reject'
        };
        return view('transactions.'.$transactionReturnViewName, compact('data'));
    }

    public function createTransactionWithPayTab(UserMembership | Appointment | Package $transactionable, $user, $amountInSAR, $description, $card_id)
    {
        $currencySymbol= getCurrencySymbol();
        $paymentCharge = $this->createTransaction([
            'tran_class'  => "ecom",
            'cart_id'     => json_encode($card_id),
            'description' => $description,
            'currency'    => $currencySymbol,
            'amount'      => $amountInSAR,
            'tokenize'    => time(),
        ]);

        $transaction = $transactionable->transactions()->create([
            'payment_charge_id' => $paymentCharge['tran_ref'],
            'amount'            => $amountInSAR,
            'description'       => $description,
            'user_id'           => $user->id,
            'currency'          => $currencySymbol,
            'status'            => Transaction::STATUS_HOLD,
        ]);
        return ['paymentCharge' => $paymentCharge, 'transaction' => $transaction];
    }
}
