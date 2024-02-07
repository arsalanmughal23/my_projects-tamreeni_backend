<?php

namespace App\Http\Requests\API;

use App\Models\Project;
use App\Http\Requests\API\BaseAPIRequest;

class UpdateProjectAPIRequest extends BaseAPIRequestuestuest
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
        $rules = Project::$rules;
        
        return $rules;
    }
}
