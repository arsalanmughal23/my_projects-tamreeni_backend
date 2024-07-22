<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            ConstantSeeder::class,
            WellnessTipsSeeder::class,
            MealCategoriesSeeder::class,
            MealTypeWithMealSeeder::class,
            ExerciseEquipmentsSeeder::class,
            BodyPartsSeeder::class,
            EventsTableSeeder::class,
            ExerciseSeeder::class,
            QuestionAndOptionSeeder::class,
            PageSeeder::class,
            PackagesTableSeeder::class,
            RecipeWithRelationalDataSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
