<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'slot_id' => $this->faker->word,
        'package_id' => $this->faker->word,
        'transaction_id' => $this->faker->word,
        'date' => $this->faker->word,
        'start_time' => $this->faker->word,
        'end_time' => $this->faker->word,
        'currency' => $this->faker->word,
        'amount' => $this->faker->randomDigitNotNull,
        'type' => $this->faker->randomDigitNotNull,
        'profession_type' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
