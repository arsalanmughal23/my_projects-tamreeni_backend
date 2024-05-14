<?php

namespace Database\Seeders;

use App\Models\BodyPart;
use DB;
use Illuminate\Database\Seeder;

class BodyPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bodyParts = [
            [ 'slug' => 'back', 'image' => 'biceps-image.jpg' ],
            [ 'slug' => 'arms', 'image' => 'biceps-image.jpg' ],
            [ 'slug' => 'chest', 'image' => 'biceps-image.jpg' ],
            [ 'slug' => 'abs', 'image' => 'biceps-image.jpg' ],
            [ 'slug' => 'legs', 'image' => 'biceps-image.jpg' ],
            // Add more data as needed
        ];

        foreach($bodyParts as $bodyPart) {
            $bodyPart['name'] = ['en' => __('options.'.$bodyPart['slug'], [], 'en'), 'ar' => __('options.'.$bodyPart['slug'], [], 'ar')];
            BodyPart::create($bodyPart);
        }
    }
}
