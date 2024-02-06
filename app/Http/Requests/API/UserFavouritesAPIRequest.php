<?php

namespace App\Http\Requests\API;

use App\Http\Requests\API\BaseAPIRequest;
use App\Http\Requests\API\RequestResponse;


class UserFavouritesAPIRequest extends BaseAPIRequest
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
            'type' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Type is required.',
        ];
    }
}
