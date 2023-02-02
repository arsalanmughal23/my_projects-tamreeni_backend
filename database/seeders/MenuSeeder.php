<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'Pages',
                'icon' => 'glass',
                'slug' => 'pages',
                'position' => 1,
                'status' => 1,
                'created_at' =>  now(),
                'updated_at' =>  now()
            ],
            [
                'name' => 'Setting',
                'icon' => 'cog',
                'slug' => 'settings',
                'position' => 2,
                'status' => 1,
                'created_at' =>  now(),
                'updated_at' =>  now()
            ]
        ];

        Menu::insert($menus);
    }
}
