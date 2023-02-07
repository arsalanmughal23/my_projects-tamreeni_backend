<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constant = [
            [
                'instance_type' => 1,
                'text' => 'junior',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ],
            [
                'instance_type' => 1,
                'text' => 'mid',
                'value' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ],
            [
                'instance_type' => 1,
                'text' => 'senior',
                'value' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ],
        ];

        DB::table('constants')->insert($constant);
    }
}
