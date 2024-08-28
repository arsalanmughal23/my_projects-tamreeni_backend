<?php

namespace App\Console\Commands;

use App\Constants\NotificationServiceTemplateNames;
use App\Models\WorkoutDay;
use App\Models\WorkoutPlan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class WorkoutReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workout:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Workout Reminder & Update Workout-Plan / Workout-Day Statuses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::alert($this->signature . ' | '. now()->format('d-M H:i:s'));
        $date = Carbon::now();
        $dateTimeStartOfDay = $date->startOfDay();

        // Mark Todo Status as In-Progress of the WorkoutPlan
        WorkoutPlan::where('start_date', $dateTimeStartOfDay)
            ->where('status', WorkoutPlan::STATUS_TODO)
            ->update(['status' => WorkoutPlan::STATUS_IN_PROGRESS]);

        // Mark In-Progress Status as Completed of the WorkoutPlan
        WorkoutPlan::where('end_date', $dateTimeStartOfDay->subDay())
            ->where('status', WorkoutPlan::STATUS_IN_PROGRESS)
            ->update(['status' => WorkoutPlan::STATUS_COMPLETED]);


        // Mark Todo Status as In-Progress of the WorkoutDay
        WorkoutDay::where('date', $dateTimeStartOfDay)
            ->where('status', WorkoutDay::STATUS_TODO)
            ->update(['status' => WorkoutDay::STATUS_IN_PROGRESS]);

        // Mark In-Progress Status as Completed of the WorkoutDay
        WorkoutDay::where('date', $dateTimeStartOfDay->subDay())
            ->where('status', WorkoutDay::STATUS_IN_PROGRESS)
            ->update(['status' => WorkoutDay::STATUS_COMPLETED]);


        // Get All InProgress WorkoutDays those have workoutDayExercises
        $workoutDays = WorkoutDay::whereHas('workoutPlan', function($q){
            return $q->where('status', WorkoutPlan::STATUS_IN_PROGRESS);
        })
        ->whereHas('workoutDayExercises')
        ->where('status', WorkoutDay::STATUS_IN_PROGRESS)
        ->get();

        // Send Notification to App Users for their workout reminder
        foreach($workoutDays as $workoutDay) {
            $user = $workoutDay->user();
            if(!$user)
                continue;

            $notificationType = NotificationServiceTemplateNames::WORKOUT_REMINDERS;

            $message = [__('workoutday.notification.message', [], 'en'), __('workoutday.notification.message', [], 'ar')];

            $title = [
                __('workoutday.notification.title', [], 'en'),
                __('workoutday.notification.title', [], 'ar')
            ];

            sendNotification($user, $notificationType, $workoutDay->id, $title, $message);
        }

        return 0;
    }
}
