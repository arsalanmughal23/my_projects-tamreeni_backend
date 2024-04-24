<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AppBaseController;
use App\Models\User;

class PaymentController extends AppBaseController
{
    public static $endPoints = [
        'create.customer'   => 'v1/stripe/customer',
        'create.pricing'    => 'v1/stripe/subscriptions/price',
        'payment.charge'    => 'v1/stripe/charge',
        'payment.intent'    => 'v1/stripe/payment-intent',
        'create.session'    => 'v1/stripe/subscriptions/create-session',
        'ephemeral.key'     => 'v2/stripe/create-ephemeral-key',
    ];

    public static function post(Request $request, $endPoint)
    {
        if (!array_key_exists($endPoint, self::$endPoints)) {
            throw new \Exception("Invalid Payment service Endpoint");
        }

        $token   = config('payment-service.token');
        $baseUrl = config('payment-service.base_url');

        $headers = [
            'Content-Type'   => 'application/json',
            'x-access-token' => $token
        ];

        try {
            $response = Http::withHeaders($headers)->post($baseUrl . '/' . self::$endPoints[$endPoint], $request->all());
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('payment_service_err-->' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function delete(Request $request, $endPoint, $id)
    {
        if (!array_key_exists($endPoint, self::$endPoints)) {
            throw new \Exception("Invalid Payment service Endpoint");
        }

        $token   = config('payment-service.token');
        $baseUrl = config('payment-service.base_url');

        $headers = [
            'Content-Type'   => 'application/json',
            'x-access-token' => $token
        ];

        try {
            $response = Http::withHeaders($headers)->delete($baseUrl . '/' . self::$endPoints[$endPoint] . '/' . $id);
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('payment_service_err-->' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function patch(Request $request, $endPoint, $id)
    {
        if (!array_key_exists($endPoint, self::$endPoints)) {
            throw new \Exception("Invalid Payment service Endpoint");
        }

        $token   = config('payment-service.token');
        $baseUrl = config('payment-service.base_url');

        $headers = [
            'Content-Type'   => 'application/json',
            'x-access-token' => $token
        ];

        try {
            $response = Http::withHeaders($headers)->patch($baseUrl . '/' . self::$endPoints[$endPoint] . '/' . $id, $request->all());
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('payment_service_err-->' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function get(Request $request, $endPoint, $id = null)
    {
        if (!array_key_exists($endPoint, self::$endPoints)) {
            throw new \Exception("Invalid Payment service Endpoint");
        }

        $token   = config('payment-service.token');
        $baseUrl = config('payment-service.base_url');

        $params = $request->all(); // You can adjust this to fetch specific query parameters if needed

        $query = http_build_query($params);

        $headers = [
            'Content-Type'   => 'application/json',
            'x-access-token' => $token
        ];

        try {
            $response = Http::withHeaders($headers)->get($baseUrl . '/' . self::$endPoints[$endPoint] . '/' . ($id ?? '') . '?' . $query);
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('payment_service_err-->' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function makePaymentIntent($amountInSAR, $description, $customer_id)
    {
        $CENTS_PER_SAR = config('payment-service.cents_per_sar');
        $MINIMUM_CHARGEABLE_CENTS = config('payment-service.minimum_chargeable_cents');
        $amountInCents = intval($amountInSAR * $CENTS_PER_SAR);

        if($amountInCents < $MINIMUM_CHARGEABLE_CENTS)
            throw new \Error('Amount must be equal or greater than '.$MINIMUM_CHARGEABLE_CENTS.' cents');

        $paymentIntentReqst = new Request(['amount' => $amountInCents, 'description' => $description, 'customer_id' => $customer_id]);
        return self::post($paymentIntentReqst, 'payment.intent');
    }

    public static function makeEphemeralKey($stripeCustomerId)
    {        
        $ephemeralKeyReqst = new Request(['customer_id' => $stripeCustomerId]);
        return self::post($ephemeralKeyReqst, 'ephemeral.key');
    }

    public static function charge($paymentIntentId, $paymentMethodId)
    {
        $chargeRequest = new Request(['payment_intent_id' => $paymentIntentId, 'payment_method_id' => $paymentMethodId]);
        return self::post($chargeRequest, 'payment.charge');
    }

    public function createCustomer(Request $request)
    {
        try {
            $response = self::post($request, 'create.customer');
            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public static function createPaymentIntent(User $user, $amountInSAR, $description)
    {
        try{
            if(!$user->stripe_customer_id){
                $emailRequest       = new Request(['email' => $user->email]);
                $stripe_customer    = PaymentController::post($emailRequest, 'create.customer');
                $user->stripe_customer_id = $stripe_customer['data']['id'];
                $user->save();
            }

            $CENTS_PER_SAR = config('payment-service.cents_per_sar');
            $MINIMUM_CHARGEABLE_CENTS = config('payment-service.minimum_chargeable_cents');
            $amountInCents = intval($amountInSAR * $CENTS_PER_SAR);

            if($amountInCents < $MINIMUM_CHARGEABLE_CENTS)
                throw new \Error('Amount must be equal or greater than '.$MINIMUM_CHARGEABLE_CENTS.' cents');

            $paymentIntent = self::makePaymentIntent($amountInCents, $description, $user->stripe_customer_id);

            if(!$paymentIntent['status'])
                throw new \Error('Payment intent is not created');
            
            $ephemeralKeyReqst = new Request(['customer_id' => $user->stripe_customer_id]);
            $ephemeralKey      = self::post($ephemeralKeyReqst, 'ephemeral.key');
            if(!$ephemeralKey['status'])
                throw new \Error('Ephemeral key is not created');

            $ephemeralKeyData = $ephemeralKey['data'];
            $paymentIntentData = $paymentIntent['data']['paymentIntent'];

            $data = [
                'ephemeralKey'  => $ephemeralKeyData,
                'paymentIntent' => $paymentIntentData
            ];

            return $data;

        } catch (\Error $e) {
            throw new \Error($e->getMessage());

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
