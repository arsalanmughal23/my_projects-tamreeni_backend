<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

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
            'name' => "Super-Admin",
        ]);

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@yopmail.com',
            'password' => '123456'
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '123 Main St, City',
            'phone_number' => '123-456-7890',
            'dob' => '1990-01-01', // Replace with the actual date of birth
            'image' => 'path/to/image.jpg', // Replace with the actual image path
            'email_verified_at' => 1, // Assuming email is verified at the time of creation
            'is_social_login' => 0, // Assuming it's not a social login
            'language' => 'en', // Replace with the desired language
            'gender' => 'male', // Replace with the desired gender
            'current_weight_in_kg' => 70.5, // Replace with the actual current weight
            'target_weight_in_kg' => 65.0, // Replace with the actual target weight
            'height_in_m' => 1.75, // Replace with the actual height
            'goal' => 'goal__lose_weight', // Replace with the desired goal
            'diet_type' => 'diet_type__traditional', // Replace with the desired diet type
            'current_weight_unit' => 'weight_unit__kg', // Replace with the desired weight unit
            'target_weight_unit' => 'weight_unit__kg', // Replace with the desired weight unit
            'height_unit' => 'height_unit__m', // Replace with the desired height unit
        ]);



    }
}
