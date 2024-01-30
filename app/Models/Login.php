<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    public static $rules = [
        'email'    => 'required|email|exists:users,email',
        'password' => 'required',
    ];

    public static $api_rules = [
        'email'         => 'required|email|exists:users,email',
        'password'      => 'required',
        'device_token'  => 'required',
        'device_type'   => 'required|string|in:ios,android,web',
    ];
}
