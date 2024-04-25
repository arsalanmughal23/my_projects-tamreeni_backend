<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Slot;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PaymentController;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coachRole = Role::whereName(Role::COACH)->first();
        $dietitianRole = Role::whereName(Role::DIETITIAN)->first();
        $therapistRole = Role::whereName(Role::THERAPIST)->first();

        User::create([
            'name' => 'super-admin',
            'email' => 'super-admin@boilerplate.com',
            'password' => '123456',
        ])->assignRole(Role::SUPER_ADMIN);

        User::create([
            'name' => 'admin',
            'email' => 'admin@boilerplate.com',
            'password' => '123456',
        ])->assignRole(Role::ADMIN);

            // $apiUserRole = Role::whereName(Role::API_USER)->first();
            // $apiUser = User::create([
            //     'name' => 'App User1',
            //     'email' => 'appuser1@yopmail.com',
            //     'email_verified_at' => now(),
            //     'password' => 'Demo@123'
            // ])->assignRole($apiUserRole);
            // $apiUser->details()->create();

            // $emailRequest       = new Request(['email' => $apiUser->email]);
            // $stripe_customer    = PaymentController::post($emailRequest, 'create.customer');
            // $input['stripe_customer_id'] = $stripe_customer['data']['id'];
            // $apiUser->update(['stripe_customer_id' => $stripe_customer['data']['id']]);

        $coachUser = User::create([
            'name' => 'Coach 1',
            'email' => 'coach1@yopmail.com',
            'email_verified_at' => now(),
            'password' => 'Demo@123'
        ])->assignRole($coachRole);
        Slot::insert([
            [ "user_id" => $coachUser->id, "start_time" => "08:00 PM", "end_time" => "09:00 PM", "day" => "Monday", "type" => 10 ],
            [ "user_id" => $coachUser->id, "start_time" => "09:00 PM", "end_time" => "10:00 PM", "day" => "Monday", "type" => 20 ],
            [ "user_id" => $coachUser->id, "start_time" => "10:00 PM", "end_time" => "11:00 PM", "day" => "Monday", "type" => 30 ]
        ]);

        User::create([
            'name' => 'Dietitian',
            'email' => 'dietitian1@yopmail.com',
            'email_verified_at' => now(),
            'password' => 'Demo@123'
        ])->assignRole($dietitianRole);
        
        User::create([
            'name' => 'Therapist',
            'email' => 'therapist1@yopmail.com',
            'email_verified_at' => now(),
            'password' => 'Demo@123'
        ])->assignRole($therapistRole);
    }
}
