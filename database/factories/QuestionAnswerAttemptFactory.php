<?php

namespace Database\Factories;

use App\Models\QuestionAnswerAttempt;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionAnswerAttemptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuestionAnswerAttempt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'dob' => $this->faker->word,
        'age' => $this->faker->randomDigitNotNull,
        'gender' => $this->faker->word,
        'language' => $this->faker->word,
        'goal' => $this->faker->word,
        'workout_days_in_a_week' => $this->faker->word,
        'how_long_time_to_workout' => $this->faker->word,
        'workout_duration_per_day' => $this->faker->word,
        'equipment_type' => $this->faker->word,
        'height_in_cm' => $this->faker->randomDigitNotNull,
        'height' => $this->faker->randomDigitNotNull,
        'height_unit' => $this->faker->word,
        'current_weight_in_kg' => $this->faker->randomDigitNotNull,
        'current_weight' => $this->faker->randomDigitNotNull,
        'current_weight_unit' => $this->faker->word,
        'target_weight_in_kg' => $this->faker->randomDigitNotNull,
        'target_weight' => $this->faker->randomDigitNotNull,
        'target_weight_unit' => $this->faker->word,
        'reach_goal_target_date' => $this->faker->word,
        'body_parts' => $this->faker->word,
        'physically_active' => $this->faker->word,
        'level' => $this->faker->word,
        'squat__one_rep_max_in_kg' => $this->faker->randomDigitNotNull,
        'deadlift__one_rep_max_in_kg' => $this->faker->randomDigitNotNull,
        'bench__one_rep_max_in_kg' => $this->faker->randomDigitNotNull,
        'overhead__one_rep_max_in_kg' => $this->faker->randomDigitNotNull,
        'health_status' => $this->faker->word,
        'daily_steps_taken' => $this->faker->word,
        'diet_type' => $this->faker->word,
        'food_preferences' => $this->faker->word,
        'calories' => $this->faker->randomDigitNotNull,
        'algo_required_calories' => $this->faker->randomDigitNotNull,
        'bmi' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'workout_plan_id' => $this->faker->word,
        'nutrition_plan_id' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
