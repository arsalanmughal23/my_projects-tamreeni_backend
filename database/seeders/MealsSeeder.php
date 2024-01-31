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
                'image' => 'path/to/image1.jpg',
                'calories' => 500,
                'description' => 'This is a sample traditional meal description.',
            ],
            [
                'diet_type' => 'keto',
                'meal_category_id' => 2, // Replace with the ID of another meal category
                'name' => 'Sample Keto Meal 1',
                'image' => 'path/to/image2.jpg',
                'calories' => 300,
                'description' => 'This is a sample keto meal description.',
            ],
        ];

        DB::table('meals')->insert($meals);
    }
}
