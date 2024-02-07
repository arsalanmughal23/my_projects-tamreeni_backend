<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\BaseAPIRequest;

class VerifyOTPAPIRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'otp' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'type' => 'required|in:email,password'
        ];
    }
}
