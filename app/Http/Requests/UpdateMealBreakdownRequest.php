<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\MealBreakdown;
use App\Rules\MealBreakdownUniqueDietTypeCalories;
use App\Rules\UniqueDietTypeCalories;

class UpdateMealBreakdownRequest extends FormRequest
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
        $mealBreakdownId = $this->route('meal_breakdown');
        $rules = MealBreakdown::$rules;
        array_push($rules['total_calories'], new MealBreakdownUniqueDietTypeCalories($this->diet_type, $this->total_calories, $mealBreakdownId));
        return $rules;
    }
}
