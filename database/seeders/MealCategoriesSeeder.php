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
            [ 'diet_type' => 'traditional', 'name' => json_encode(['en'=>'eggs', 'ar'=>'بيض']) ],
            [ 'diet_type' => 'traditional', 'name' => json_encode(['en'=>'shrimp', 'ar'=>'جمبري']) ],
            [ 'diet_type' => 'keto', 'name' => json_encode(['en'=>'veggies', 'ar'=>'الخضار']) ],
        ];

        DB::table('meal_categories')->insert($categories);
    }
}
