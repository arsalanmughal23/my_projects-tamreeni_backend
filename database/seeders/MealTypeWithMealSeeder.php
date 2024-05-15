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
                    'calories'         => 800,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 900,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1000,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1100,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1200,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1300,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1400,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1500,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1600,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 1700,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
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
                    'calories'         => 1900,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2000,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2100,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2200,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2300,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2400,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2500,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2600,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2700,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2800,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 2900,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3000,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3100,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3200,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3300,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3400,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3500,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3600,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3700,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3800,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 3900,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.keto', [], 'en'), 'ar' => __('general.keto', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_2_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_2_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_2_description', [], 'ar')],
                ],
                [
                    'meal_category_id' => 1,
                    'calories'         => 4000,
                    'image'            => 'https://placehold.co/400',
                    'diet_type'        => ['en' => __('general.traditional', [], 'en'), 'ar' => __('general.traditional', [], 'ar')],
                    'name'             => ['en' => __('meal.'.$mealType.'_meal_1_name', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_name', [], 'ar')],
                    'description'      => ['en' => __('meal.'.$mealType.'_meal_1_description', [], 'en'), 'ar' => __('meal.'.$mealType.'_meal_1_description', [], 'ar')],
                ]
            ]);

        }
    }
}
