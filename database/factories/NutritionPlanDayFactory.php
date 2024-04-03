<?php

namespace Database\Factories;

use App\Models\NutritionPlanDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionPlanDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NutritionPlanDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nutrition_plan_id' => $this->faker->word,
        'name' => $this->faker->word,
        'status' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
