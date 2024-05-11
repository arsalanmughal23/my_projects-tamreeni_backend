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
            // CATEGORY_MAJOR_LIFT
            [
                'user_id' => 1,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 1], 'en'), 'ar' => __('messages.exercise_title', ['number' => 1], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT,
                'exercise_type_name' => Exercise::TYPE_BENCH,
                'duration_in_m' => 30,
                'sets' => 3,
                'reps' => 12,
                'burn_calories' => 150,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/01.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/01.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 1], 'en'), 'ar' => __('messages.exercise_description', ['number' => 1], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'body_part_id' => 2,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 2], 'en'), 'ar' => __('messages.exercise_title', ['number' => 2], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT,
                'exercise_type_name' => Exercise::TYPE_DEADLIFT,
                'duration_in_m' => 20,
                'sets' => 4,
                'reps' => 10,
                'burn_calories' => 120,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/02.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/02.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 2], 'en'), 'ar' => __('messages.exercise_description', ['number' => 2], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 3], 'en'), 'ar' => __('messages.exercise_title', ['number' => 3], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT,
                'exercise_type_name' => Exercise::TYPE_OVERHEAD,
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/03.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/03.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 3], 'en'), 'ar' => __('messages.exercise_description', ['number' => 3], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 4], 'en'), 'ar' => __('messages.exercise_title', ['number' => 4], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT,
                'exercise_type_name' => Exercise::TYPE_SQUAT,
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/04.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/04.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 4], 'en'), 'ar' => __('messages.exercise_description', ['number' => 4], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // CATEGORY_ACCESSORY_MOVEMENT
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 4], 'en'), 'ar' => __('messages.exercise_title', ['number' => 4], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_ACCESSORY_MOVEMENT,
                'exercise_type_name' => null,
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/04.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/04.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 4], 'en'), 'ar' => __('messages.exercise_description', ['number' => 4], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // CATEGORY_SINGLE_JOINT
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 4], 'en'), 'ar' => __('messages.exercise_title', ['number' => 4], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_SINGLE_JOINT,
                'exercise_type_name' => null,
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/04.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/04.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 4], 'en'), 'ar' => __('messages.exercise_description', ['number' => 4], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // CATEGORY_MULTI_JOINT
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 4], 'en'), 'ar' => __('messages.exercise_title', ['number' => 4], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_MULTI_JOINT,
                'exercise_type_name' => null,
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/04.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/04.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 4], 'en'), 'ar' => __('messages.exercise_description', ['number' => 4], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // CATEGORY_CARDIO
            [
                'user_id' => 2,
                'body_part_id' => 1,
                'name' => json_encode(['en' => __('messages.exercise_title', ['number' => 4], 'en'), 'ar' => __('messages.exercise_title', ['number' => 4], 'ar')]),
                'exercise_category_name' => Exercise::CATEGORY_CARDIO,
                'exercise_type_name' => null,
                'duration_in_m' => 40,
                'sets' => 3,
                'reps' => 15,
                'burn_calories' => 180,
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/Exercises/04.jpg',
                'video' => 'https://tamreeni-backend.s3.amazonaws.com/ExerciseVideos/04.mp4',
                'description' => json_encode(['en' => __('messages.exercise_description', ['number' => 4], 'en'), 'ar' => __('messages.exercise_description', ['number' => 4], 'ar')]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert the records into the database
        Exercise::insert($exercises);
    }
}
