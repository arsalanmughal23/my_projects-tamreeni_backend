<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
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
            "callback"         => "https://webhook.site/8efb723d-af00-4d4c-a3d4-3c5973aaba5c",
            "return"           => url('/paytabs-return'),
            "tokenize"         => "2", //for tokenized transaction
            "customer_details" => [
                "name"    => "John Smith",
                "email"   => "jsmith@gmail.com",
                "street1" => "404, 11th st, void",
                "city"    => "dubai",
                "country" => "AE",
                "ip"      => "94.204.129.89"
            ],
            "shipping_details" => [
                "name"    => "name1 last1",
                "email"   => "email1@domain.com",
                "phone"   => "971555555555",
                "street1" => "street2",
                "city"    => "dubai",
                "state"   => "dubai",
                "country" => "AE",
                "zip"     => "54321",
                "ip"      => "2.2.2.2"
            ],
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

    public function paytabs_return(Request $request)
    {
        dd($request->all());
    }
}
