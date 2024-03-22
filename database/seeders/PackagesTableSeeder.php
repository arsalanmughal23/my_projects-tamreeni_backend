<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for packages
        $packages = [
            [
                'name' => 'Package #01',
                'description' => '4 sessions',
                'currency' => 'SAR',
                'amount' => 49.55,
                'sessions' => 4,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Package #02',
                'description' => '3 sessions',
                'currency' => 'SAR',
                'amount' => 99.00,
                'sessions' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Package #03',
                'description' => '5 sessions',
                'currency' => 'SAR',
                'amount' => 149.99,
                'sessions' => 5,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the data into the packages table
        DB::table('packages')->insert($packages);
    }
}
