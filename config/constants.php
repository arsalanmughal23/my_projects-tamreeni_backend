<?php
return [
    'expiry_in_seconds' => [
        'otp'       => 10 * 60,
        'api_token' => 24 * 60 * 60
    ],
    'validation'        => [
        'users'       => [
            'name'           => [
                'size_max' => 255,
            ],
            'email'          => [
                'size_max' => 255,
            ],
            'password'       => [
                'size_min' => 6,
            ],
            'remember_token' => [
                'size_max' => 100,
            ]
        ],
        'role'        => [
            'name' => [
                'size_max' => 255,
            ],
        ],
        'permissions' => [
            'name' => [
                'size_max' => 255,
            ],
        ],

    ],
    'PER_PAGE'          => '10',
    's3'                => [
        'token'         => env('S3TOKEN'),
        'presignedUrl'  => env('AWS_PRESIGNED_URL'),
        'accelerateUrl' => env('AWS_ACCELERATED_URL'),
    ],
    "paytabs"           => [
        'PAYTABS_PROFILE_ID' => env('PAYTABS_PROFILE_ID'),
        'PAYTABS_SERVER_KEY' => env('PAYTABS_SERVER_KEY'),
        'PAYTABS_SERVER_URL' => env('PAYTABS_SERVER_URL'),
    ]
];
