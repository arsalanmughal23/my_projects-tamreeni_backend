<?php

namespace Database\Factories;

use App\Models\Constant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConstantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Constant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instance_type' => $this->faker->randomDigitNotNull,
        'text' => $this->faker->word,
        'value' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
