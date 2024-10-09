<?php

namespace Database\Factories;

use App\Models\ExerciseBreakdown;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseBreakdownFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExerciseBreakdown::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'goal' => $this->faker->word,
        'how_long_time_to_workout' => $this->faker->word,
        'exercise_category' => $this->faker->word,
        'exercise_count' => $this->faker->word,
        'sets' => $this->faker->word,
        'reps' => $this->faker->word,
        'time' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
