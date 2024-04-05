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
            [ 'diet_type' => 'traditional', 'name' => json_encode(['en'=>'Vegetarian', 'ar'=>'نباتي']) ],
            [ 'diet_type' => 'traditional', 'name' => json_encode(['en'=>'Lactose Free', 'ar'=>'خالي من اللاكتوز']) ],
            [ 'diet_type' => 'keto', 'name' => json_encode(['en'=>'Gluten Free', 'ar'=>'خالي من الغلوتين']) ],
        ];

        DB::table('meal_categories')->insert($categories);
    }
}
