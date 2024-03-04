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
                'name' => 'Sample Traditional Meal 1',
                'image' => 'https://placehold.co/400',
                'calories' => 500,
                'description' => 'This is a sample traditional meal 1 description.',
            ],
            [
                'diet_type' => 'keto',
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'name' => 'Sample Keto Meal 1',
                'image' => 'https://placehold.co/400',
                'calories' => 300,
                'description' => 'This is a sample keto meal 1 description.',
            ],
            [
                'diet_type' => 'keto',
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'name' => 'Sample Keto Meal 2',
                'image' => 'https://placehold.co/400',
                'calories' => 400,
                'description' => 'This is a sample keto meal 2 description.',
            ],
            [
                'diet_type' => 'traditional',
                'meal_category_id' => 1, // Replace with the ID of a meal category
                'name' => 'Sample Traditional Meal 2',
                'image' => 'https://placehold.co/400',
                'calories' => 200,
                'description' => 'This is a sample traditional meal 2 description.',
            ]
        ];

        DB::table('meals')->insert($meals);
    }
}
