<?php

namespace Database\Factories;

use App\Models\UserMembership;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMembership::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text,
        'user_id' => $this->faker->word,
        'membership_id' => $this->faker->word,
        'membership_duration_id' => $this->faker->word,
        'duration_in_month' => $this->faker->word,
        'expire_at' => $this->faker->date('Y-m-d H:i:s'),
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
