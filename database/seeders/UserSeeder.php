<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'super-admin',
            'email' => 'super-admin@boilerplate.com',
            'password' => '123456',
        ]);

        DB::table('roles')->insert([
            [
                'name'          => Role::SUPER_ADMIN,
                'guard_name'         => 'web',
            ],
            [
                'name'          => Role::ADMIN,
                'guard_name'         => 'web',
            ],
            [
                'name'          => Role::API_USER,
                'guard_name'         => 'api',
            ],
            [
                'name'          => Role::COACH,
                'guard_name'         => 'api',
            ],
            [
                'name'          => Role::DIETITIAN,
                'guard_name'         => 'api',
            ],
            [
                'name'          => Role::THERAPIST,
                'guard_name'         => 'api',
            ]
        ]);

        
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@yopmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456')
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St, City',
            'phone_number' => '123-456-7890',
            // 'dob' => '1990-01-01', // Replace with the actual date of birth
            // 'image' => null, // Replace with the actual image path
            // 'is_social_login' => 0, // Assuming it's not a social login
            // 'language' => 'en', // Replace with the desired language
            // 'gender' => 'male', // Replace with the desired gender
            // 'current_weight_in_kg' => 70.5, // Replace with the actual current weight
            // 'target_weight_in_kg' => 65.0, // Replace with the actual target weight
            // 'height_in_m' => 1.75, // Replace with the actual height
            // 'goal' => 'lose_weight', // Replace with the desired goal
            // 'diet_type' => 'traditional', // Replace with the desired diet type
            // 'current_weight_unit' => 'kg', // Replace with the desired weight unit
            // 'target_weight_unit' => 'kg', // Replace with the desired weight unit
            // 'height_unit' => 'm', // Replace with the desired height unit
        ]);

    }
}
