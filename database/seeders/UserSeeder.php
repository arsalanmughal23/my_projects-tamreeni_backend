<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
            [
                'name'          => Role::SUPER_ADMIN,
                'guard_name'         => 'web',
                // 'description'   => "Super Admin has all permissions"
            ],
            [
                'name'          => Role::ADMIN,
                'guard_name'         => 'web',
                // 'description'   => "Assign this role to all the users who are administrators."
            ],
            [
                'name'          => Role::API_USER,
                'guard_name'         => 'api',
                // 'description'   => "User users will be able to access mobile-app features"
            ]
        ]);

    }
}
