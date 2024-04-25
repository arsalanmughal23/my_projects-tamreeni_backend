<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [ 'name' => Role::SUPER_ADMIN, 'guard_name' => 'web' ],
            [ 'name' => Role::ADMIN, 'guard_name' => 'web' ],
            [ 'name' => Role::API_USER, 'guard_name' => 'api' ],
            [ 'name' => Role::COACH, 'guard_name' => 'web' ],
            [ 'name' => Role::DIETITIAN, 'guard_name' => 'web' ],
            [ 'name' => Role::THERAPIST, 'guard_name' => 'web' ]
        ]);
    }
}
