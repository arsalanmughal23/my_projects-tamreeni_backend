<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mealTypes = [
            [
                'name' => json_encode(['en' => 'Breakfast', 'ar' => 'فطور']),
            ],
            [
                'name' => json_encode(['en' => 'Lunch', 'ar' => 'غداء']),
            ],
            [
                'name' => json_encode(['en' => 'Dinner', 'ar' => 'عشاء']),
            ],
        ];
        DB::table('meal_types')->insert($mealTypes);
    }
}
