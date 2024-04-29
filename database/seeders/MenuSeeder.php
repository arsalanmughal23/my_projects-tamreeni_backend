<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();

        $menus = [
            ['name' => 'Users', 'icon' => 'users', 'slug' => 'users', 'position' => 1, 'status' => 1],
            ['name' => 'Slots', 'icon' => 'calendar', 'slug' => 'slots', 'position' => 2, 'status' => 1],
            ['name' => 'Appointments', 'icon' => 'calendar', 'slug' => 'appointments', 'position' => 3, 'status' => 1],
            ['name' => 'Questions', 'icon' => 'question', 'slug' => 'questions', 'position' => 4, 'status' => 1],

            ['name' => 'Meal Types', 'icon' => 'cutlery', 'slug' => 'meal_types', 'position' => 5, 'status' => 1],
            ['name' => 'Meal Categories', 'icon' => 'list-ul', 'slug' => 'meal_categories', 'position' => 6, 'status' => 1],
            ['name' => 'Meals', 'icon' => 'cutlery', 'slug' => 'meals', 'position' => 7, 'status' => 1],

            ['name' => 'Exercises', 'icon' => 'dumbbell', 'slug' => 'exercises', 'position' => 8, 'status' => 1],

            ['name' => 'Packages', 'icon' => 'folder', 'slug' => 'packages', 'position' => 9, 'status' => 1],
            ['name' => 'User Subscriptions', 'icon' => 'reorder', 'slug' => 'user_subscriptions', 'position' => 10, 'status' => 1],
            ['name' => 'Transactions', 'icon' => 'dollar', 'slug' => 'transactions', 'position' => 11, 'status' => 1],

            ['name' => 'Pages', 'icon' => 'glass', 'slug' => 'pages', 'position' => 12, 'status' => 1],
            ['name' => 'Setting', 'icon' => 'cog', 'slug' => 'settings', 'position' => 13, 'status' => 1],

            // ['name' => 'Workout Days', 'icon' => 'glass', 'slug' => 'workout_days', 'position' => 14, 'status' => 1],
            // ['name' => 'Workout Day Exercises', 'icon' => 'glass', 'slug' => 'workout_day_exercises', 'position' => 15, 'status' => 1],
            // ['name' => 'Workout Plans', 'icon' => 'glass', 'slug' => 'workout_plans', 'position' => 16, 'status' => 1],
            // ['name' => 'Nutrition Plans', 'icon' => 'glass', 'slug' => 'nutrition_plans', 'position' => 17, 'status' => 1],
            // ['name' => 'Nutrition Plan Days', 'icon' => 'glass', 'slug' => 'nutrition_plan_days', 'position' => 18, 'status' => 1],
            // ['name' => 'Nutrition Plan Day Meals', 'icon' => 'glass', 'slug' => 'nutrition_plan_day_meals', 'position' => 19, 'status' => 1],
        ];

        Menu::insert($menus);
    }
}
