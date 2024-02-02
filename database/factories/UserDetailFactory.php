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
            'user_id' => 1,
            'first_name' => $this->faker->word,
            'last_name' => $this->faker->word,
            'address' => $this->faker->word,
            'phone_number' => $this->faker->word,
            'dob' => $this->faker->date,
            'image' => $this->faker->imageUrl,
            'is_social_login' => $this->faker->boolean,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'language' => $this->faker->randomElement(['en', 'ar']),
            'current_weight_in_kg' => $this->faker->randomDigitNotNull,
            'target_weight_in_kg' => $this->faker->randomDigitNotNull,
            'height_in_m' => $this->faker->randomDigitNotNull,
            'goal_id' => $this->faker->numberBetween(1, 4),
            'height_unit_id' => $this->faker->numberBetween(5, 6),
            'current_weight_unit_id' => $this->faker->numberBetween(7, 8),
            'target_weight_unit_id' => $this->faker->numberBetween(9, 10),
            'diet_type_id' => $this->faker->numberBetween(11, 12),
            // 'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
