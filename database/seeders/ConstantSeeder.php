<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Constant;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Values for the 'goal' group
        $this->seedGroup('goal', [
            'lose_weight',
            'gain_weight',
            'build_muscle',
            'get_fit',
        ]);

        // Values for the 'gender' group
        $this->seedGroup('gender', [
            'male',
            'female',
        ]);

        // Values for the 'diet_types' group
        $this->seedGroup('diet_types', [
            'traditional',
            'keto',
        ]);

        // Values for the 'size_unit' group
        $this->seedGroup('size_unit', [
            'cm',
            'm',
        ]);

        // Values for the 'weight_units' group
        $this->seedGroup('weight_units', [
            'kg',
            'lbs',
        ]);

        // Values for the 'languages' group
        $this->seedGroup('languages', [
            'en',
            'ar',
        ]);

        // Values for the 'user_variables' group
        $this->seedGroup('user_variables', [
            // Add user variable options here
        ]);

        // Values for the 'meal_types' group
        $this->seedGroup('meal_types', [
            'breakfast',
            'lunch',
            'dinner',
        ]);

        // Values for the 'pages' group
        $this->seedGroup('pages', [
            'about_us',
            'terms_and_conditions',
            'privacy_policy',
        ]);
    }

    /**
     * Seed constants for a specific group and keys.
     *
     * @param string $group
     * @param array $keys
     * @return void
     */
    private function seedGroup($group, $keys)
    {
        foreach ($keys as $key) {
            Constant::create([
                'name' => $group,
                'group' => $group,
                'key' => $key,
                'value' => '',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }
    }
}
