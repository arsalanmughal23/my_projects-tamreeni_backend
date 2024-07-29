<?php

namespace Database\Factories;

use App\Models\UsedPromoCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsedPromoCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsedPromoCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'morphable_type' => $this->faker->word,
        'morphable_id' => $this->faker->word,
        'code' => $this->faker->word,
        'value' => $this->faker->word,
        'type' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
