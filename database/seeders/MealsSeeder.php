<?php

namespace Database\Seeders;

use App\Models\Meal;
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
                'diet_type'        => json_encode(['en' => Meal::DIET_TYPE_TRADITION_EN, 'ar' => Meal::DIET_TYPE_TRADITION_AR]),
                'meal_category_id' => 1, // Replace with the ID of a meal category
                'meal_type_id'     => 1,
                'name'             => json_encode(['en' => 'Sample Traditional Meal 1', 'ar' => 'عينة من الوجبة التقليدية 1']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 500,
                'carbs'            => 10,
                'protein'          => 20,
                'fats'             => 30,
                'description'      => json_encode(['en' => 'This is a sample traditional meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
            ],
            [
                'diet_type'        => json_encode(['en' => Meal::DIET_TYPE_KETO_EN, 'ar' => Meal::DIET_TYPE_KETO_AR]),
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'meal_type_id'     => 2,
                'name'             => json_encode(['en' => 'Sample Traditional Meal 2', 'ar' => 'عينة من الوجبة التقليدية 2']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 300,
                'carbs'            => 10,
                'protein'          => 20,
                'fats'             => 30,
                'description'      => json_encode(['en' => 'This is a sample traditional meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
            ],
            [
                'diet_type'        => json_encode(['en' => Meal::DIET_TYPE_KETO_EN, 'ar' => Meal::DIET_TYPE_KETO_AR]),
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'meal_type_id'     => 3,
                'name'             => json_encode(['en' => 'Sample Traditional Meal 3', 'ar' => 'عينة من الوجبة التقليدية 3']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 400,
                'carbs'            => 10,
                'protein'          => 20,
                'fats'             => 30,
                'description'      => json_encode(['en' => 'This is a sample traditional meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
            ],
            [
                'diet_type'        => json_encode(['en' => Meal::DIET_TYPE_TRADITION_EN, 'ar' => Meal::DIET_TYPE_TRADITION_AR]),
                'meal_category_id' => 1, // Replace with the ID of a meal category
                'meal_type_id'     => 1,
                'name'             => json_encode(['en' => 'Sample Traditional Meal 4', 'ar' => 'عينة من الوجبة التقليدية 4']),
                'image'            => 'https://placehold.co/400',
                'calories'         => 200,
                'carbs'            => 10,
                'protein'          => 20,
                'fats'             => 30,
                'description'      => json_encode(['en' => 'This is a sample traditional meal description.', 'ar' => 'هذا نموذج لوصف الوجبة التقليدية.']),
            ]
        ];

        DB::table('meals')->insert($meals);
    }
}
