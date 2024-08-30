<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CheckPromoCodeAPIRequest extends BaseAPIRequest
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
        $user = $this->user();
        return [
            'code' => 'required|exists:promo_codes,code',
            'membership_id' => 'required|exists:memberships,id'
        ];
    }

    public function messages()
    {
        return [
            'code.exists' => 'The promo code is invalid.',
            'code.unique' => 'You already used this promo code'
        ];
    }
}
