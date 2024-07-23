<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MealBreakdownUniqueDietTypeCalories implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        protected $dietType, 
        protected $totalCalories, 
        protected $ignoreId = null
    ) {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !DB::table('meal_breakdowns')
            ->where('diet_type', $this->dietType)
            ->where('total_calories', $this->totalCalories)
            ->where('id', '!=', $this->ignoreId)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The combination of diet type and total calories already exists.';
    }
}
