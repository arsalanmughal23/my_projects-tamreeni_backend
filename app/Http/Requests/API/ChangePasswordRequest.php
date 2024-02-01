<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\API\RequestResponse;
use App\Http\Requests\API\BaseAPIRequest;


class ChangePasswordRequest extends BaseAPIRequest
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
            'current_password' => 'required',
            'password'              => 'min:8|required|same:password_confirmation|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]+$/',
            'password_confirmation' => 'min:8|required_with:password'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password format is invalid,
            at least one uppercase letter, one lowercase letter, one digit, and one special character.',
        ];
    }
}
