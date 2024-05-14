<?php

namespace Database\Seeders;

use App\Models\ExerciseEquipment;
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
            ['name' => json_encode(['en' => 'Treadmill', 'ar' => 'جهاز المشي']), 'icon' => 'treadmill-icon.png', 'type_slug' => ExerciseEquipment::EQUIPMENT_TYPES[0]],
            ['name' => json_encode(['en' => 'Dumbbells', 'ar' => 'اجراس صماء']), 'icon' => 'dumbbells-icon.png', 'type_slug' => ExerciseEquipment::EQUIPMENT_TYPES[1]],
            // Add more data as needed
        ]);
    }
}
