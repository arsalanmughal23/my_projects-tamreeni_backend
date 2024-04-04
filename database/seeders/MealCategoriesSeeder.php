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
            [ 'slug' => 'breakfast', 'title' => 'Breakfast' ],
            [ 'slug' => 'lunch', 'title' => 'Lunch' ],
            [ 'slug' => 'dinner', 'title' => 'Dinner' ],
        ];

        DB::table('meal_categories')->insert($categories);
    }
}
