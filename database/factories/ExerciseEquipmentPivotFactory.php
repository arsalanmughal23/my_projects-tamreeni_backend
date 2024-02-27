<?php

namespace Database\Factories;

use App\Models\ExerciseEquipmentPivot;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseEquipmentPivotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExerciseEquipmentPivot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'exercise_id' => $this->faker->randomDigitNotNull,
        'exercise_equipment_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
