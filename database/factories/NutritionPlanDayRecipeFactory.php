<?php

namespace Database\Factories;

use App\Models\NutritionPlanDayRecipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionPlanDayRecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NutritionPlanDayRecipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'diet_type' => $this->faker->word,
        'nutrition_plan_day_id' => $this->faker->word,
        'meal_type_id' => $this->faker->word,
        'recipe_id' => $this->faker->word,
        'meal_category_ids' => $this->faker->text,
        'title' => $this->faker->text,
        'description' => $this->faker->text,
        'image' => $this->faker->text,
        'instruction' => $this->faker->text,
        'units_in_recipe' => $this->faker->word,
        'divide_recipe_by' => $this->faker->word,
        'number_of_units' => $this->faker->word,
        'calories' => $this->faker->word,
        'carbs' => $this->faker->randomDigitNotNull,
        'fats' => $this->faker->randomDigitNotNull,
        'protein' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
