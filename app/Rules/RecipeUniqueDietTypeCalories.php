<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RecipeUniqueDietTypeCalories implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        protected $dietType, 
        protected $calories, 
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
        return !DB::table('recipes')
            ->where('diet_type', $this->dietType)
            ->where('calories', $this->calories)
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
        return 'The combination of diet type and calories already exists.';
    }
}
