<?php

namespace Database\Factories;

use App\Models\MealBreakdown;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealBreakdownFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MealBreakdown::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'diet_type' => $this->faker->word,
            'total_calories' => $this->faker->word,
            'breakfast_units' => $this->faker->word,
            'lunch_units' => $this->faker->word,
            'dinner_units' => $this->faker->word,
            'fruit_units' => $this->faker->word,
            'snack_units' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
