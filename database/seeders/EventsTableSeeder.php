<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;
use DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for events
        $eventsData = [
            [
                'title' => 'Fitness Class',
                'date' => Carbon::now(),
                'start_time' => Carbon::now()->setTime(10,00),
                'end_time' => Carbon::now()->setTime(11,30),
                'description' => 'Join our fitness class for a great workout!',
                'body_part_id' => 1, // Replace with an existing body part ID
                'equipment_id' => 1, // Replace with an existing equipment ID
                'user_id' => 1, // Replace with an existing user ID
                'status' => Event::ONGOING_EVENT,
            ],
            [
                'title' => 'Yoga Session',
                'date' => Carbon::tomorrow(),
                'start_time' => Carbon::tomorrow()->setTime(15,00),
                'end_time' => Carbon::tomorrow()->setTime(16,30),
                'description' => 'Relax and rejuvenate with our yoga session.',
                'body_part_id' => 2, // Replace with an existing body part ID
                'equipment_id' => 2, // Replace with an existing equipment ID
                'user_id' => 1, // Replace with an existing user ID
                'status' => Event::UPCOMING_EVENT,

            ],
            [
                'title' => 'Cardio Workout',
                'date' => Carbon::tomorrow()->addDays(1),
                'start_time' => Carbon::tomorrow()->addDays(1)->setTime(9,30),
                'end_time' => Carbon::tomorrow()->addDays(1)->setTime(11,00),
                'description' => 'Boost your heart health with our cardio workout.',
                'body_part_id' => 1, // Replace with an existing body part ID
                'equipment_id' => 1, // Replace with an existing equipment ID
                'user_id' => 1, // Replace with an existing user ID
                'status' => Event::UPCOMING_EVENT
            ],
        ];

        foreach ($eventsData as $event) {
            // Calculate duration
            $startTime = Carbon::parse($event['start_time']);
            $endTime = Carbon::parse($event['end_time']);
            $duration = $endTime->diffInMinutes($startTime);

            // Create the event
            Event::create([
                'title' => $event['title'],
                'date' => $event['date'],
                'start_time' => $event['start_time'],
                'end_time' => $event['end_time'],
                'duration' => $duration,
                'description' => $event['description'],
                'image' => 'https://tamreeni-backend.s3.amazonaws.com/7BJDR8UVCrRO', // Add image path if applicable
                'body_part_id' => $event['body_part_id'],
                'equipment_id' => $event['equipment_id'],
                'user_id' => $event['user_id'],
                'status' => $event['status'],
            ]);
        }
    }
}
