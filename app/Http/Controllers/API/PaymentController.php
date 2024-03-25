<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public static $endPoints = [
        'create.customer' => 'stripe/customer',
        'create.pricing'  => 'stripe/subscriptions/price',
        'payment.charge'  => 'stripe/charge',
        'payment.intent'  => 'stripe/payment-intent',
        'create.session'  => 'stripe/subscriptions/create-session',
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

    public static function charge(Request $request)
    {
        $paymentIntent = self::post($request, 'payment.intent');

        $charge = self::post([
            'payment_intent_id' => $paymentIntent['data']['id'],
            'payment_method_id' => $request->input('payment_method_id')
        ], 'payment.charge');

        return $charge;
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

}
