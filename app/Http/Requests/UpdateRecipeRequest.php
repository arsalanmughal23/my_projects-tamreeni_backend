<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Recipe;
use App\Rules\RecipeUniqueDietTypeCalories;

class UpdateRecipeRequest extends FormRequest
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
        $recipeId = $this->route('recipe');
        $rules = Recipe::$rules;
        array_push($rules['calories'], new RecipeUniqueDietTypeCalories($this->diet_type, $this->calories, $recipeId));
        return $rules;
    }
}
