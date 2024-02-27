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
            ['name' => 'Biceps', 'image' => 'biceps-image.jpg'],
            ['name' => 'Triceps', 'image' => 'triceps-image.jpg'],
            // Add more data as needed
        ]);
    }
}
