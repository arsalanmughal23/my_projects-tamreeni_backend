<?php

namespace Database\Factories;

use App\Models\NutritionPlanDayMeal;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionPlanDayMealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NutritionPlanDayMeal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nutrition_plan_day_id' => $this->faker->word,
        'meal_id' => $this->faker->randomDigitNotNull,
        'meal_category_id' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'diet_type' => $this->faker->word,
        'calories' => $this->faker->randomDigitNotNull,
        'carbs' => $this->faker->randomDigitNotNull,
        'fats' => $this->faker->randomDigitNotNull,
        'protein' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
