<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BodyPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('body_parts')->insert([
            [
                'name'  => json_encode(['en' => 'Biceps', 'ar' => 'عضلة البايسبس']),
                'image' => 'biceps-image.jpg'
            ],
            [
                'name'  => json_encode(['en' => 'Triceps', 'ar' => 'عضلة الثلاثي رؤوس']),
                'image' => 'triceps-image.jpg'
            ],
            // Add more data as needed
        ]);
    }
}
