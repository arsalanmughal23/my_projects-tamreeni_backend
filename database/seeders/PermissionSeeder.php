<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Revert your changes, ensure to enable/disable foreign key checks accordingly
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::whereName(Role::ADMIN)->first()->syncPermissions([]);
        Permission::truncate();

        // Code to revert your migration changes
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $modules = [
            'users' => [ 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'slots' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'appointments' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'questions' => [ 'index', 'show', 'edit', 'update' ],
            'options' => [ 'show', 'edit', 'update' ],
            'meal_types' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'meal_categories' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'meals' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'exercises' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'exercise_equipments' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'body_parts' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'packages' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'user_subscriptions' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            'transactions' => [ 'index', 'show' ],
            'settings' => [ 'index', 'show', 'edit', 'update' ],
            'pages' => [ 'index', 'show', 'edit', 'update' ],

            // 'constants' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'contact_requests' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'user_details' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'faqs' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'wellness_tips' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'favourites' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'events' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'user_events' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],

            // 'workout_plans' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'workout_days' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'workout_day_exercises' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'nutrition_plans' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'nutrition_plan_days' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
            // 'nutrition_plan_day_meals' => [ 'create', 'store', 'index', 'show', 'edit', 'update', 'destroy' ],
        ];

        $permissions = [];
        foreach ($modules as $moduleName => $modulePermissions) {
            foreach ($modulePermissions as $action){
                $permissions[] = Permission::create(['name' => $moduleName.'.'.$action])->name;
            }
        }

        Role::whereName(Role::ADMIN)->first()->syncPermissions($permissions);
    }
}
