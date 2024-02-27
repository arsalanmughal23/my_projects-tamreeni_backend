<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'date' => $this->faker->word,
        'start_time' => $this->faker->word,
        'end_time' => $this->faker->word,
        'duration' => $this->faker->randomDigitNotNull,
        'description' => $this->faker->text,
        'image' => $this->faker->text,
        'user_id' => $this->faker->word,
        'body_part_id' => $this->faker->randomDigitNotNull,
        'equipment_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
