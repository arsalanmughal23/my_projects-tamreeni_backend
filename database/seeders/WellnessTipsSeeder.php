<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WellnessTip;

class WellnessTipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WellnessTip::truncate();
        
        // Create wellness tips
        $wellnessTips = [
            [
                'title' => json_encode([
                    'en' => __('messages.wellness_tip.healthy_eating.title', ['number' => 1], 'en'),
                    'ar' => __('messages.wellness_tip.healthy_eating.title', ['number' => 1], 'ar'),
                ]),
                'content' => json_encode([
                    'en' => __('messages.wellness_tip.healthy_eating.content', [], 'en'),
                    'ar' => __('messages.wellness_tip.healthy_eating.content', [], 'ar')
                ]),
                'cover' => 'path/to/cover1.jpg', // Replace with the actual cover image path
            ],
            [
                'title' => json_encode([
                    'en' => __('messages.wellness_tip.stay_hydrated.title', ['number' => 2], 'en'),
                    'ar' => __('messages.wellness_tip.stay_hydrated.title', ['number' => 2], 'ar')
                ]),
                'content' => json_encode([
                    'en' => __('messages.wellness_tip.stay_hydrated.content', [], 'en'),
                    'ar' => __('messages.wellness_tip.stay_hydrated.content', [], 'ar')
                ]),
                'cover' => 'path/to/cover2.jpg', // Replace with the actual cover image path
            ],
            // Add more wellness tips as needed
        ];

        WellnessTip::insert($wellnessTips);
    }
}
