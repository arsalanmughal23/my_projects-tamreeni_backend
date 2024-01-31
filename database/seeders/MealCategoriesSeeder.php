<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MealCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['diet_type' => 'traditional', 'name' => 'Vegetarian'],
            ['diet_type' => 'traditional', 'name' => 'Lactose Free'],
            ['diet_type' => 'keto', 'name' => 'Gluten Free'],
        ];

        DB::table('meal_categories')->insert($categories);
    }
}
