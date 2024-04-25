<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            'users',
            'pages', 'settings', 
            'slots', 'appointments', 'packages', 
            'transactions', 'user_subscriptions', 
            'meal_types', 
            'workout_plans', 'workout_days', 'workout_day_exercises', 
            'nutrition_plans', 'nutrition_plan_days', 'nutrition_plan_day_meals'
        ];

        $permissions = [];
        foreach($modules as $module){
            $permissions[] = Permission::create(['name' => $module . '.create'])->name;
            $permissions[] = Permission::create(['name' => $module . '.store'])->name;
            $permissions[] = Permission::create(['name' => $module . '.index'])->name;
            $permissions[] = Permission::create(['name' => $module . '.show'])->name;
            $permissions[] = Permission::create(['name' => $module . '.edit'])->name;
            $permissions[] = Permission::create(['name' => $module . '.update'])->name;
            $permissions[] = Permission::create(['name' => $module . '.destroy'])->name;
        }

        Role::whereName(Role::ADMIN)->first()->syncPermissions($permissions);
    }
}
