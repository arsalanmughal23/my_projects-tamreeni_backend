<?php

namespace Database\Seeders;

use DB;
use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = [
            [
                'user_id' => 1,
                'body_part_id' => 1,
                'name' => 'Exercise 1',
                'duration_in_m' => 30,
                'sets' => 3,
                'reps' => 12,
                'burn_calories' => 150,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/01.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/01.mp4',
                'description' => 'Description of Exercise 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'body_part_id' => 2,
                'name' => 'Exercise 2',
                'duration_in_m' => 20,
                'sets' => 4,
                'reps' => 10,
                'burn_calories' => 120,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/02.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/02.mp4',
                'description' => 'Description of Exercise 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => 'Exercise 3',
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/03.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/03.mp4',
                'description' => 'Description of Exercise 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => 'Exercise 3',
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/04.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/04.mp4',
                'description' => 'Description of Exercise 3',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert the records into the database
        Exercise::insert($exercises);
    }
}
