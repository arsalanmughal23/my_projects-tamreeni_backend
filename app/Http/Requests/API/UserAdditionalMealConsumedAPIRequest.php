<?php

namespace App\Http\Requests\API;

class UserAdditionalMealConsumedAPIRequest extends BaseAPIRequest
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
            'meal_type_id' => 'required|integer|exists:meal_types,id',
            'name' => 'required|string|max:191',
            'calories' => 'required|numeric',
        ];
    }
}
