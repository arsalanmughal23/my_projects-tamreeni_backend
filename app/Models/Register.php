<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    public static $rules = [
        'email'                 => 'required|email|unique:users,email|max:255',
        'password'              => 'min:6|required|same:password_confirmation',
        'password_confirmation' => 'min:6|required_with:password',
        'device_token'          => 'required',
        'device_type'           => 'required|string|in:ios,android,web',
    ];
}
