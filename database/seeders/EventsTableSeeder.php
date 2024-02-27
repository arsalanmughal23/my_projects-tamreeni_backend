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
        'date' => Carbon::now()->format('Y-m-d'),
        'start_time' => '10:00:00',
        'end_time' => '11:30:00',
        'description' => 'Join our fitness class for a great workout!',
        'body_part_id' => 1, // Replace with an existing body part ID
        'equipment_id' => 1, // Replace with an existing equipment ID
        'user_id' => 1, // Replace with an existing user ID
        'status' => Event::ONGOING_EVENT,
    ],
    [
        'title' => 'Yoga Session',
        'date' => Carbon::now()->addDays(1)->format('Y-m-d'),
        'start_time' => '15:00:00',
        'end_time' => '16:30:00',
        'description' => 'Relax and rejuvenate with our yoga session.',
        'body_part_id' => 2, // Replace with an existing body part ID
        'equipment_id' => 2, // Replace with an existing equipment ID
        'user_id' => 1, // Replace with an existing user ID
        'status' => Event::UPCOMING_EVENT,

    ],
    [
        'title' => 'Cardio Workout',
        'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
        'start_time' => '09:30:00',
        'end_time' => '11:00:00',
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
        'image' => null, // Add image path if applicable
        'body_part_id' => $event['body_part_id'],
        'equipment_id' => $event['equipment_id'],
        'user_id' => $event['user_id'],
        'status' => $event['status'],
    ]);
}
        
    }
}
