<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Seeder;

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
        $this->seedGroup(Constant::GROUP_GOAL, [
            'Lose Weight',
            'Gain Weight',
            'Build Muscle',
            'Get Fit',
        ]);
        // Values for the 'size_unit' group
        $this->seedGroup(Constant::GROUP_HEIGHT_UNIT, [
            'Cm',
            'M',
        ]);
        // Values for the 'weight_units' group
        $this->seedGroup(Constant::GROUP_CURRENT_WEIGHT_UNIT, [
            'Kg',
            'Lbs',
        ]);
        // Values for the 'weight_units' group
        $this->seedGroup(Constant::GROUP_TARGET_WEIGHT_UNIT, [
            'Kg',
            'Lbs',
        ]);
        // Values for the 'diet_types' group
        $this->seedGroup(Constant::GROUP_DIET_TYPE, [
            'Traditional',
            'Keto',
        ]);
        // Values for the 'pages' group
        $this->seedGroup(Constant::GROUP_DELETE_ACCOUNT_TYPE, [
            'Privacy Concerns',
            'Inactivity',
            'Dissatisfaction with the platform or service',
            'Lack of interest in the platform or service',
            'Moving on to a different platform or service',
        ]);

        // Values for the 'gender' group
        $this->seedGroup('gender', [
            'Male',
            'Female',
        ]);
        // Values for the 'languages' group
        $this->seedGroup('languages', [
            'En',
            'Ar',
        ]);
        // Values for the 'meal_types' group
        $this->seedGroup('meal_types', [
            'Breakfast',
            'Lunch',
            'Dinner',
        ]);
        // Values for the 'pages' group
        $this->seedGroup('pages', [
            'About us',
            'Terms and Conditions',
            'Privacy Policy',
        ]);

        // Values for the 'user_variables' group
        // $this->seedGroup('user_variables', [
        //     // Add user variable options here
        // ]);
    }
    
    private function seedGroup($group, $keys)
    {
        foreach ($keys as $key) {
            Constant::create([
                'group' => $group,
                'name' => $key,
            ]);
        }
    }
}
