<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\MealBreakdown;
use Illuminate\Database\Seeder;

class MealBreakdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MealBreakdown::truncate();

        $mealBreakdownDataList = [];

        $calorie = 1000;
        $stepper = 100;
        $maxCalorie = 3000;
        
        while ($calorie <= $maxCalorie) {
            $mealBreakdownData = [
                [
                    'diet_type'         => Meal::DIET_TYPE_TRADITION_EN,
                    'total_calories'    => $calorie,
                    'breakfast_units'   => 2,
                    'lunch_units'       => 2,
                    'dinner_units'      => 2,
                    'fruit_units'       => 1,
                    'snack_units'       => 1,
                ],
                [
                    'diet_type'         => Meal::DIET_TYPE_KETO_EN,
                    'total_calories'    => $calorie,
                    'breakfast_units'   => 2,
                    'lunch_units'       => 2,
                    'dinner_units'      => 2,
                    'fruit_units'       => 1,
                    'snack_units'       => 1,
                ]
            ];
            $mealBreakdownDataList = array_merge($mealBreakdownDataList, $mealBreakdownData);
            
            $calorie += $stepper;
        }

        MealBreakdown::insert($mealBreakdownDataList);
    }
}
