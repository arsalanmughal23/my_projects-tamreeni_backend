<?php

namespace Database\Seeders;

use App\Models\MealType;
use Illuminate\Database\Seeder;

class MealTypeWithMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(MealType::ALL_NAMES as $mealType){
            MealType::create([
                'slug' => $mealType,
                'name' => ['en' => __('meal_type.'.$mealType, [], 'en'), 'ar' => __('meal_type.'.$mealType, [], 'ar')]
            ])
            ->meals()->createMany([
                [
                    'meal_category_id' => 1,
                    'calories'         => 1800,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1800,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ]
            ]);

        }
    }
}
