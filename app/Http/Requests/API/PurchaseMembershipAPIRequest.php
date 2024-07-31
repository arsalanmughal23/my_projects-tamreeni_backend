<?php

namespace App\Http\Requests\API;

use App\Models\UserMembership;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseMembershipAPIRequest extends BaseAPIRequest
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
            'membership_duration_id' => 'required|exists:membership_durations,id',
            'code' => 'exists:promo_codes,code|unique:used_promo_codes,code,NULL,id,user_id,'.$user->id,
        ];
    }

    public function messages()
    {
        return [
            'membership_duration_id.exists' => 'Membership duration id is invalid',
            'code.exists' => 'Code is invalid',
            'code.unique' => 'Code is already used'
        ];
    }
}
