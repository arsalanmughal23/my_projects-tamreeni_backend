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
            ['name' => 'Pages', 'icon' => 'glass', 'slug' => 'pages', 'position' => 1, 'status' => 1],
            ['name' => 'Setting', 'icon' => 'cog', 'slug' => 'settings', 'position' => 2, 'status' => 1],
            ['name' => 'Slots', 'icon' => 'calendar', 'slug' => 'slots', 'position' => 0, 'status' => 1],
            ['name' => 'Appointments', 'icon' => 'check', 'slug' => 'appointments', 'position' => 0, 'status' => 1],
            ['name' => 'Packages', 'icon' => 'folder', 'slug' => 'packages', 'position' => 0, 'status' => 1],
            ['name' => 'Transactions', 'icon' => 'dollar', 'slug' => 'transactions', 'position' => 0, 'status' => 1],
            ['name' => 'User Subscriptions', 'icon' => 'reorder', 'slug' => 'user_subscriptions', 'position' => 0, 'status' => 1],
            ['name' => 'Meal Types', 'icon' => 'cutlery', 'slug' => 'meal_types', 'position' => 0, 'status' => 1],
            ['name' => 'Workout Days', 'icon' => 'glass', 'slug' => 'workout_days', 'position' => 0, 'status' => 1],
            ['name' => 'Workout Day Exercises', 'icon' => 'glass', 'slug' => 'workout_day_exercises', 'position' => 0, 'status' => 1],
            ['name' => 'Workout Plans', 'icon' => 'glass', 'slug' => 'workout_plans', 'position' => 0, 'status' => 1],
            ['name' => 'Nutrition Plans', 'icon' => 'glass', 'slug' => 'nutrition_plans', 'position' => 0, 'status' => 1],
            ['name' => 'Nutrition Plan Days', 'icon' => 'glass', 'slug' => 'nutrition_plan_days', 'position' => 0, 'status' => 1],
            ['name' => 'Nutrition Plan Day Meals', 'icon' => 'glass', 'slug' => 'nutrition_plan_day_meals', 'position' => 0, 'status' => 1],
        ];

        Menu::insert($menus);
    }
}
