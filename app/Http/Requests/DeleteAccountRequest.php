<?php

namespace App\Http\Requests;

use App\Models\Constant;
use Illuminate\Foundation\Http\FormRequest;

class DeleteAccountRequest extends FormRequest
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
            'delete_account_type_id' => 'required|int|exists:constants,id,group,'.Constant::GROUP_DELETE_ACCOUNT_TYPE
        ];
    }
}
