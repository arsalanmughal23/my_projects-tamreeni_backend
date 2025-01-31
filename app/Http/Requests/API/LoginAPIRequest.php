<?php

namespace App\Http\Requests\API;

use App\Models\Login;
use App\Http\Requests\API\BaseAPIRequest;

class LoginAPIRequest extends BaseAPIRequest
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
        return Login::$api_rules;
    }
}
