<?php
return [
    'expiry_in_seconds' => [
        'otp' => 5 * 60,
        'api_token' => 24 * 60 * 60
    ],
    'validation' => [
        'users' => [
            'name' => [
                'size_max' => 255,
            ],
            'email' => [
                'size_max' => 255,
            ],
            'password' => [
                'size_min' => 6,
            ],
            'remember_token' => [
                'size_max' => 100,
            ]
        ],
        'role' => [
            'name' => [
                'size_max' => 255,
            ],
        ],
        'permissions' => [
            'name' => [
                'size_max' => 255,
            ],
        ],

    ]
];
