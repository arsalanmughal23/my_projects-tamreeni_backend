<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Option;

class UpdateOptionRequest extends FormRequest
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
        return Option::$rules;
    }

    public function messages()
    {
        return [
            'title.en.required'        => 'The English title field is required.',
            'title.ar.required'        => 'The Arabic title field is required.',
        ];
    }
}
