<?php

namespace Database\Factories;

use App\Models\NplanDayRecipeIngredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class NplanDayRecipeIngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NplanDayRecipeIngredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'recipe_id' => $this->faker->word,
        'type' => $this->faker->word,
        'name' => $this->faker->text,
        'quantity' => $this->faker->word,
        'unit' => $this->faker->word,
        'scaled_quantity' => $this->faker->word,
        'scaled_unit' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
