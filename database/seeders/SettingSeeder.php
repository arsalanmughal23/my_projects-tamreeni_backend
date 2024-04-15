<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            'title' => 'Tamreeni',
            'welcome_title' => 'Welcome to Tamreeni',
            'url' => '',
            'logo' => '',
            'email' => '',
            'contact_number' => '',
            'language' => '',
            'service_fee' => '7.45',
            'coach_fee' => '105.50',
            'dietitian_fee' => '100.00',
            'therapist_fee' => '220.30',
        ]);
    }
}
