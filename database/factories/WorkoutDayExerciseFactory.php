<?php

namespace Database\Factories;

use App\Models\WorkoutDayExercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutDayExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkoutDayExercise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'workout_day_id' => $this->faker->word,
        'exercise_id' => $this->faker->randomDigitNotNull,
        'duration' => $this->faker->randomDigitNotNull,
        'sets' => $this->faker->randomDigitNotNull,
        'reps' => $this->faker->randomDigitNotNull,
        'burn_calories' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
