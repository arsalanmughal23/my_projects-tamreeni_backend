<?php
return [
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

    ],
    'PER_PAGE' => '10',
];
