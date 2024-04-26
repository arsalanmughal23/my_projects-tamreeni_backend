<?php
return [
    'token' => env('PAYMENT_SERVICE_TOKEN'),
    'base_url' => env('PAYMENT_SERVICE_BASE_URL'),
    'currency' => env('CURRENCY', 'SAR'),
    'cents_per_sar' => env('CENTS_PER_SAR', 2663.70),
    'minimum_chargeable_cents' => 186
];