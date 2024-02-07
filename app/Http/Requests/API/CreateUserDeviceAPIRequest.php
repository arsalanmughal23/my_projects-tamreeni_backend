<?php

namespace App\Http\Requests\API;

use App\Models\UserDevice;
use App\Http\Requests\API\BaseAPIRequest;

class CreateUserDeviceAPIRequest extends BaseAPIRequest
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
        return UserDevice::$rules;
    }
}
