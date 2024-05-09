<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Models\Option;
use App\Models\UserDetail;
use App\Models\WorkoutDay;
use App\Models\WorkoutDayExercise;
use App\Models\WorkoutPlan;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class WorkoutPlanRepository
 * @package App\Repositories
 * @version April 2, 2024, 8:09 am UTC
*/

class WorkoutPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return WorkoutPlan::class;
    }
    public function generateWorkoutPlan(UserDetail $userDetails, Carbon $planStartDate, Carbon $planEndDate)
    {
        $numberOfDaysPerWeek = Option::$DAYS_PER_WEEK[$userDetails->workout_days_in_a_week] ?? 0;
        $weekWiseDates       = generateDatesByWeek($planStartDate, $planEndDate);
        if(!count($weekWiseDates) > 0)
            return null;

        /* Mark complete previous workout plan */
        WorkoutPlan::where('user_id', \Auth::id())->update([
            'status' => WorkoutPlan::STATUS_COMPLETED
        ]);

        $randomDates         = [];
        foreach ($weekWiseDates as $key => $weekDates) {
            if (count($weekDates) >= $numberOfDaysPerWeek) {
                $randomDates = array_merge($randomDates, pickRandomIndices($weekDates, $numberOfDaysPerWeek));
            }
        }
        $workoutPlan = WorkoutPlan::create([
            'user_id'    => \Auth::id(),
            'name'       => 'Workout Plan',
            'start_date' => $randomDates[0],
            'end_date'   => $randomDates[count($randomDates) - 1],
            'status'     => WorkoutPlan::STATUS_TODO

        ]);
        switch ($userDetails->goal) {
            case Option::Q1_OPT1__LOSE_WEIGHT:
                $this->generateWaitLosePlan($workoutPlan->id, $randomDates, $userDetails);
                break;
            case Option::Q1_OPT2__GAIN_WEIGHT:
                $this->generateWaitGainPlan($workoutPlan->id, $randomDates, $userDetails);
                break;
            case Option::Q1_OPT3__BUILD_MUSCLE:
                $this->generateBuildMusclesPlan($workoutPlan->id, $randomDates, $userDetails);
                break;
            case Option::Q1_OPT4__GET_FIT:
                $this->generateGetFitPlan($workoutPlan->id, $randomDates, $userDetails);
                break;
        }
        return $workoutPlan;
    }

    public function generateWaitLosePlan($workoutPlanId, $randomDates, $user)
    {
        //TODO: get exercises as per define criteria
        $exercises = Exercise::all();
        /* create workout day and workout day exercises  */
        $this->assignWorkoutDaysAndExercises($randomDates, $exercises, $workoutPlanId);
    }

    public function generateWaitGainPlan($workoutPlanId, $randomDates, $user)
    {
        //TODO: get exercises as per define criteria
        $exercises = Exercise::all();
        /* create workout day and workout day exercises  */
        $this->assignWorkoutDaysAndExercises($randomDates, $exercises, $workoutPlanId);
    }

    public function generateBuildMusclesPlan($workoutPlanId, $randomDates, $user)
    {
        //TODO: get exercises as per define criteria
        $exercises = Exercise::all();
        /* create workout day and workout day exercises  */
        $this->assignWorkoutDaysAndExercises($randomDates, $exercises, $workoutPlanId);
    }

    public function generateGetFitPlan($workoutPlanId, $randomDates, $user)
    {
        //TODO: get exercises as per define criteria
        $exercises = Exercise::all();
        /* create workout day and workout day exercises  */
        $this->assignWorkoutDaysAndExercises($randomDates, $exercises, $workoutPlanId);
    }

    public function assignWorkoutDaysAndExercises($randomDates, $exercises, $workoutPlanId)
    {
        $durationOfAllExercises = array_sum($exercises->pluck('duration_in_m')->toArray());
        foreach ($randomDates as $key => $randomDate) {
            $workoutDay = WorkoutDay::create([
                'workout_plan_id' => $workoutPlanId,
                'name'            => [
                    'en' => 'Day 0' . $key + 1,
                    'ar' => 'اليوم 0' . $key + 1
                ],
                'description'     => [
                    'en' => WorkoutDay::DESCRIPTION_EN,
                    'ar' => WorkoutDay::DESCRIPTION_AR
                ],
                'date'            => Carbon::parse($randomDate),
                'duration'        => $durationOfAllExercises,
                'image'           => $exercises[0]->image ?? null,
                'status'          => WorkoutDay::STATUS_TODO
            ]);
            foreach ($exercises as $index => $exercise) {
                WorkoutDayExercise::create([
                    'workout_day_id' => $workoutDay->id,
                    'exercise_id'    => $exercise->id,
                    'duration'       => $exercise->duration_in_m,
                    'sets'           => $exercise->sets,
                    'reps'           => $exercise->reps,
                    'burn_calories'  => $exercise->burn_calories,
                    'status'         => WorkoutDayExercise::STATUS_TODO
                ]);
            }
        }
    }
}
