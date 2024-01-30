<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'first_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'address' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'dob' => $this->faker->word,
        'image' => $this->faker->word,
        'email_verified_at' => $this->faker->word,
        'is_social_login' => $this->faker->word,
        'gender' => $this->faker->word,
        'language' => $this->faker->word,
        'current_weight_in_kg' => $this->faker->randomDigitNotNull,
        'target_weight_in_kg' => $this->faker->randomDigitNotNull,
        'height_in_m' => $this->faker->randomDigitNotNull,
        'goal' => $this->faker->word,
        'diet_type' => $this->faker->word,
        'current_weight_unit' => $this->faker->word,
        'target_weight_unit' => $this->faker->word,
        'height_unit' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
