<?php

namespace Database\Factories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exercise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'body_part_id' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'duration_in_m' => $this->faker->randomDigitNotNull,
        'sets' => $this->faker->randomDigitNotNull,
        'reps' => $this->faker->randomDigitNotNull,
        'burn_calories' => $this->faker->randomDigitNotNull,
        'image' => $this->faker->text,
        'video' => $this->faker->text,
        'description' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
