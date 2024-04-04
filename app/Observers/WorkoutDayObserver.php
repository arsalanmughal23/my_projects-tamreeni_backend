<?php

namespace App\Observers;

use App\Models\WorkoutDay;
use App\Models\WorkoutPlan;

class WorkoutDayObserver
{
    /**
     * Handle the WorkoutDay "created" event.
     *
     * @param  \App\Models\WorkoutDay $workoutDay
     * @return void
     */
    public function created(WorkoutDay $workoutDay)
    {

    }

    /**
     * Handle the WorkoutDay "updated" event.
     *
     * @param  \App\Models\WorkoutDay $workoutDay
     * @return void
     */
    public function updated(WorkoutDay $workoutDay)
    {
        if ($workoutDay->getOriginal('status') != WorkoutDay::STATUS_COMPLETED && $workoutDay->status == WorkoutDay::STATUS_COMPLETED) {
            /* check if all workout day is completed then mark workout plan as completed */
            $remainingDays = WorkoutDay::where('workout_plan_id', $workoutDay->workout_plan_id)->whereIn('status', [
                WorkoutDay::STATUS_TODO, WorkoutDay::STATUS_IN_PROGRESS
            ])->first();
            /* check if no any day remaining then mark workout plan as completed */
            if (!isset($remainingDays)) {
                WorkoutPlan::where('id', $workoutDay->workout_plan_id)->update([
                    'status' => WorkoutPlan::STATUS_COMPLETED
                ]);
            }
        }

        /* start workout plan if any day marked inprogress */
        if ($workoutDay->getOriginal('status') == WorkoutDay::STATUS_TODO && $workoutDay->status == WorkoutDay::STATUS_IN_PROGRESS) {
            /* check if workout plan status is todo then mark it inprogress */
            $workoutPlan = WorkoutPlan::where('id', $workoutDay->workout_plan_id)->first();
            if ($workoutPlan->status == WorkoutPlan::STATUS_TODO) {
                $workoutPlan->status = WorkoutPlan::STATUS_IN_PROGRESS;
                $workoutPlan->save();
            }
        }
    }

    /**
     * Handle the WorkoutDay "deleted" event.
     *
     * @param  \App\Models\WorkoutDay $workoutDay
     * @return void
     */
    public function deleted(WorkoutDay $workoutDay)
    {
        //
    }

    /**
     * Handle the WorkoutDay "restored" event.
     *
     * @param  \App\Models\WorkoutDay $workoutDay
     * @return void
     */
    public function restored(WorkoutDay $workoutDay)
    {
        //
    }

    /**
     * Handle the WorkoutDay "force deleted" event.
     *
     * @param  \App\Models\WorkoutDay $workoutDay
     * @return void
     */
    public function forceDeleted(WorkoutDay $workoutDay)
    {
        //
    }
}
