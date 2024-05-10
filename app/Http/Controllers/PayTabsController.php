<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Transaction;
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

    function create_payment_page()
    {
        $fields   = [
            "profile_id"       => env('PAYTABS_PROFILE_ID', 110359),
            "tran_type"        => "sale",
            "tran_class"       => "ecom",//ecom | recurring
            "cart_id"          => "Bsaray Sample Payment",
            "cart_description" => "Dummy Order 35925502061445345",
            "cart_currency"    => "SAR",
            "cart_amount"      => 46.17,
            "callback"         => url('/paytabs-callback'),
            "return"           => url('/paytabs-return'),
            "tokenize"         => "2", //for tokenized transaction
//            "customer_details" => [
//                "name"    => "John Smith",
//                "email"   => "jsmith@gmail.com",
//                "street1" => "404, 11th st, void",
//                "city"    => "dubai",
//                "country" => "AE",
//                "ip"      => "94.204.129.89"
//            ],
//            "shipping_details" => [
//                "name"    => "name1 last1",
//                "email"   => "email1@domain.com",
//                "phone"   => "971555555555",
//                "street1" => "street2",
//                "city"    => "dubai",
//                "state"   => "dubai",
//                "country" => "AE",
//                "zip"     => "54321",
//                "ip"      => "2.2.2.2"
//            ],
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => env('PAYTABS_SERVER_KEY', 'S6JNJBK9H2-JJDKTGLM6T-T6LMRMGBH9'),
            'Content-type'  => 'application/json'
        ])->post('https://secure.paytabs.sa/payment/request', $fields);

        return $response->json();

    }

    function query_transaction(Request $request)
    {
        $fields   = [
            "profile_id" => env('PAYTABS_PROFILE_ID', 110359),
            'tran_ref'   => $request->input('tran_ref') // example
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => env('PAYTABS_SERVER_KEY', 'S6JNJBK9H2-JJDKTGLM6T-T6LMRMGBH9'),
            'Content-type'  => 'application/json'
        ])->post('https://secure.paytabs.sa/payment/query', $fields);

        return $response->json();
    }

    public function createTransaction($data)
    {
        $fields   = [
            "profile_id"       => config('constants.paytabs.PAYTABS_PROFILE_ID', 110359),
            "tran_type"        => "sale",
            "tran_class"       => $data['tran_class'],//ecom | recurring
            "cart_id"          => $data['cart_id'],
            "cart_description" => $data['description'],
            "cart_currency"    => $data['currency'],
            "cart_amount"      => $data['amount'],
            "callback"         => url('/paytabs-callback'),//"https://webhook.site/8b9635dd-d2f9-4f0f-8133-2f9d66af3793"
            "return"           => url('/paytabs-return'),
            "tokenize"         => $data['tokenize'], //for tokenized transaction
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => env('PAYTABS_SERVER_KEY', 'S6JNJBK9H2-JJDKTGLM6T-T6LMRMGBH9'),
            'Content-type'  => 'application/json'
        ])->post('https://secure.paytabs.sa/payment/request', $fields);
        // TODO :: Need to remove logger
        \Illuminate\Support\Facades\Log::info('test appointment api: fields: '.json_encode($fields));
        \Illuminate\Support\Facades\Log::info('test appointment api: response: '.json_encode($response->json()));
        return $response->json();
    }

    public function callBackFunction(Request $request)
    {
        try{        
            DB::beginTransaction();
            $transaction = Transaction::where(['payment_charge_id' => $request->tran_ref, 'status' => Transaction::STATUS_HOLD])->first();

            if(!$transaction)
                throw new \Error('Transaction is not found, Webhook Payload is: '.json_encode($request->all()));

            if ($request->payment_result['response_status'] == Transaction::PAY_TABS_SUCCESS_STATUS) {
                $transaction->update(['status' => Transaction::STATUS_COMPLETE]);
                $transaction->appointments()->update(['status' => Appointment::STATUS_PAYMENT_PAID]);

            } else {
                $transaction->update(['status' => Transaction::STATUS_CANCEL]);
                $transaction->appointments()->update(['status' => Appointment::STATUS_PAYMENT_REJECT]);
                // Appointment::where('transaction_id', $transaction->id)->delete();
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
        return view('transactions.payment_return');
    }
}
