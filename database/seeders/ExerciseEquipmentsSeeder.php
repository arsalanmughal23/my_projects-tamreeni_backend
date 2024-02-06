<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ExerciseEquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercise_equipments')->insert([
            ['name' => 'Treadmill', 'icon' => 'treadmill-icon.png', 'type' => 'Machines'],
            ['name' => 'Dumbbells', 'icon' => 'dumbbells-icon.png', 'type' => 'Free Weights'],
            // Add more data as needed
        ]);
    }
}
