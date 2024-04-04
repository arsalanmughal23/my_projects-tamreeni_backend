<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = [
            [
                'diet_type' => 'traditional',
                'meal_category_id' => 1, // Replace with the ID of a meal category
                'name'             => json_encode(['en' => 'Sample Traditional Meal 1', 'ar' => 'عينة من الوجبة التقليدية 1']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 500,
                'description'      => json_encode(['en' => 'This is a sample traditional meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
                // 'carbs'            => 10,
                // 'protein'          => 20,
                // 'fats'             => 30,
                // 'meal_type_id'     => 1,
            ],
            [
                'diet_type' => 'keto',
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'name'             => json_encode(['en' => 'Sample Keto Meal 2', 'ar' => 'عينة من الوجبة التقليدية 2']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 300,
                'description'      => json_encode(['en' => 'This is a sample keto meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
                // 'carbs'            => 10,
                // 'protein'          => 20,
                // 'fats'             => 30,
                // 'meal_type_id'     => 2,
            ],
            [
                'diet_type' => 'keto',
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'name'             => json_encode(['en' => 'Sample Keto Meal 3', 'ar' => 'عينة من الوجبة التقليدية 3']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 400,
                'description'      => json_encode(['en' => 'This is a sample keto meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
                // 'carbs'            => 10,
                // 'protein'          => 20,
                // 'fats'             => 30,
                // 'meal_type_id'     => 3,
            ],
            [
                'diet_type' => 'traditional',
                'meal_category_id' => 1, // Replace with the ID of a meal category
                'name'             => json_encode(['en' => 'Sample Traditional Meal 4', 'ar' => 'عينة من الوجبة التقليدية 4']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 200,
                'description'      => json_encode(['en' => 'This is a sample traditional meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
                // 'carbs'            => 10,
                // 'protein'          => 20,
                // 'fats'             => 30,
                // 'meal_type_id'     => 1,
            ]
        ];

        DB::table('meals')->insert($meals);
    }
}
