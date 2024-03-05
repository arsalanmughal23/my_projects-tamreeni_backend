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
            UserSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            ConstantSeeder::class,
            WellnessTipsSeeder::class,
            MealCategoriesSeeder::class,
            MealsSeeder::class,
            ExerciseEquipmentsSeeder::class,
            BodyPartsSeeder::class,
            EventsTableSeeder::class,
            ExerciseSeeder::class,
            ExerciseEquipmentsPivotSeeder::class,
            QuestionAndOptionSeeder::class,
            PageSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
