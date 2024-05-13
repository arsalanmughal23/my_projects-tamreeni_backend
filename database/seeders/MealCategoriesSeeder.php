<?php

namespace Database\Seeders;

use App\Models\MealCategory;
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
        $mealCategories = [
            [ 'diet_type' => 'traditional', 'slug' => 'eggs' ],
            [ 'diet_type' => 'keto', 'slug' => 'fish' ],
            [ 'diet_type' => 'traditional', 'slug' => 'shrimp' ],
            [ 'diet_type' => 'traditional', 'slug' => 'dairy' ],
            [ 'diet_type' => 'keto', 'slug' => 'veggies' ],
            [ 'diet_type' => 'traditional', 'slug' => 'sea_food' ],
        ];

        foreach($mealCategories as $mealCategory){
            $mealCategory['name'] = ['en' => __('meal_category.'.$mealCategory['slug'], [], 'en'), 'ar' => __('meal_category.'.$mealCategory['slug'], [], 'ar')];
            MealCategory::create($mealCategory);
        }

    }
}
