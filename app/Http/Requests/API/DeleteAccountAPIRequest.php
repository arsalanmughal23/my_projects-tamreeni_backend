<?php

namespace App\Http\Requests\API;

use App\Models\Constant;
use App\Http\Requests\API\BaseAPIRequest;

class DeleteAccountAPIRequest extends BaseAPIRequest
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
