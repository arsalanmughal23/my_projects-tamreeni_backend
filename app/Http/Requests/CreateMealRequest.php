<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Meal;

class CreateMealRequest extends FormRequest
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
        return Meal::$rules;
    }

    public function messages()
    {
        return [
            'name.en.required' => 'The English name field is required.',
            'name.ar.required' => 'The Arabic name field is required.',
            'description.en.required' => 'The English description field is required.',
            'description.ar.required' => 'The Arabic description field is required.',
        ];
    }
}
