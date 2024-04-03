<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Models\Option;
use App\Models\WorkoutDay;
use App\Models\WorkoutDayExercise;
use App\Models\WorkoutPlan;
use App\Repositories\BaseRepository;

/**
 * Class WorkoutDayRepository
 * @package App\Repositories
 * @version April 1, 2024, 8:01 am UTC
 */
class WorkoutDayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'description',
        'duration',
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
        return WorkoutDay::class;
    }

    public function generateWorkoutPlan($user)
    {
        /* Mark complete previous workout plan */
        WorkoutPlan::where('user_id', \Auth::id())->update([
            'status' => WorkoutPlan::STATUS_COMPLETED
        ]);
        $numberOfDaysPerWeek = Option::$DAYS_PER_WEEK[$user->workout_days_in_a_week] ?? 0;
        $weekWiseDates       = generateDatesByWeek(date('Y-m-d'), $user->reach_goal_target_date);
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
        switch ($user->goal) {
            case Option::Q1_OPT1__LOSE_WEIGHT:
                $this->generateWaitLosePlan($workoutPlan->id, $randomDates, $user);
                break;
            case Option::Q1_OPT2__GAIN_WEIGHT:
                $this->generateWaitGainPlan($workoutPlan->id, $randomDates, $user);
                break;
            case Option::Q1_OPT3__BUILD_MUSCLE:
                $this->generateBuildMusclesPlan($workoutPlan->id, $randomDates, $user);
                break;
            case Option::Q1_OPT4__GET_FIT:
                $this->generateGetFitPlan($workoutPlan->id, $randomDates, $user);
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
                'date'            => $randomDate,
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
