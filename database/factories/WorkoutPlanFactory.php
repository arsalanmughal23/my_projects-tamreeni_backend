<?php

namespace Database\Factories;

use App\Models\WorkoutPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkoutPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'name' => $this->faker->word,
        'start_date' => $this->faker->word,
        'end_date' => $this->faker->word,
        'status' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
