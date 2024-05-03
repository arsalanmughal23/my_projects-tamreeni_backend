<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\BodyPart;

class UpdateBodyPartRequest extends FormRequest
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
        $rules = BodyPart::$rules;
        
        return $rules;
    }

    public function messages()
    {
        return [
            'name.en.required' => 'The English name field is required.',
            'name.ar.required' => 'The Arabic name field is required.',
        ];
    }
}
