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
        // Create wellness tips
        $wellnessTips = [
            [
                'title' => 'Tip 1: Healthy Eating',
                'content' => 'Include a variety of fruits, vegetables, and whole grains in your diet for better health.',
                'cover' => 'path/to/cover1.jpg', // Replace with the actual cover image path
            ],
            [
                'title' => 'Tip 2: Stay Hydrated',
                'content' => 'Drink an adequate amount of water throughout the day to stay hydrated and support bodily functions.',
                'cover' => 'path/to/cover2.jpg', // Replace with the actual cover image path
            ],
            // Add more wellness tips as needed
        ];

        foreach ($wellnessTips as $tip) {
            WellnessTip::create($tip);
        }
    }
}
