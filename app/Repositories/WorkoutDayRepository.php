<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Models\Option;
use App\Models\WorkoutDay;
use App\Models\WorkoutDayExercise;
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
        switch ($user->goal) {
            case Option::Q1_OPT1__LOSE_WEIGHT:
                $this->generateWaitLosePlan($user);
                break;
            case Option::Q1_OPT2__GAIN_WEIGHT:

                break;
            case Option::Q1_OPT3__BUILD_MUSCLE:

                break;
            case Option::Q1_OPT4__GET_FIT:

                break;
        }
    }

    public function generateWaitLosePlan($user)
    {
        //TODO: get exercises as per define criteria
        $exercises              = Exercise::all();
        $durationOfAllExercises = array_sum($exercises->pluck('duration_in_m')->toArray());
        $numberOfDaysPerWeek    = Option::$DAYS_PER_WEEK[$user->workout_days_in_a_week] ?? 0;
        $weekWiseDates          = generateDatesByWeek(date('Y-m-d'), $user->reach_goal_target_date);
        $randomDates            = [];
        foreach ($weekWiseDates as $key => $weekDates) {
            if (count($weekDates) >= $numberOfDaysPerWeek) {
                $randomDates = array_merge($randomDates, pickRandomIndices($weekDates, $numberOfDaysPerWeek));
            }
        }
        foreach ($randomDates as $key => $randomDate) {
            $data       = [
                'user_id'     => \Auth::id(),
                'name'        => 'Day 0' . $key + 1,
                'description' => WorkoutDay::DESCRIPTION,
                'date'        => $randomDate,
                'duration'    => $durationOfAllExercises,
                'status'      => WorkoutDay::STATUS_TODO
            ];
            $workoutDay = WorkoutDay::create($data);
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
        return [];

    }
}
