<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Exercise;
use App\Models\ExerciseEquipment;

class ExerciseEquipmentsPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
// Get some exercise and equipment IDs
$exerciseIds = Exercise::pluck('id')->toArray();
$equipmentIds = ExerciseEquipment::pluck('id')->toArray();

// Create some pivot records
foreach ($exerciseIds as $exerciseId) {
    // Shuffle the equipment IDs array
    shuffle($equipmentIds);

    // Get a random number of equipment IDs (between 2 and 3)
    $numEquipment = rand(2, min(3, count($equipmentIds)));

    // Select the first $numEquipment elements
    $randomEquipmentIds = array_slice($equipmentIds, 0, $numEquipment);

    foreach ($randomEquipmentIds as $equipmentId) {
        DB::table('exercise_equipment_pivots')->insert([
            'exercise_id' => $exerciseId,
            'exercise_equipment_id' => $equipmentId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

    }
}
