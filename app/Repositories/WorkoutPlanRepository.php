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
    public function __construct(
        private ExerciseRepository $exerciseRepository,
    ){}
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

        // create workout day and workout day exercises
        $workoutPlanDays = [];
        foreach ($randomDates as $key => $randomDate) {

            $workoutDay = WorkoutDay::create([
                'workout_plan_id' => $workoutPlan->id,
                'name'            => [
                    'en' => 'Day 0' . $key + 1,
                    'ar' => 'اليوم 0' . $key + 1
                ],
                'description'     => [
                    'en' => WorkoutDay::DESCRIPTION_EN,
                    'ar' => WorkoutDay::DESCRIPTION_AR
                ],
                'date'            => Carbon::parse($randomDate),
                'status'          => WorkoutDay::STATUS_TODO,
                'duration'        => 0,
                'image'           => null,
            ]);

            // TODO : assign workoutday exercises
            $workoutDayExercises = collect($this->assignWorkoutDayExercises($userDetails, $workoutDay->id));
            $workoutDay->update(['duration' => $workoutDayExercises->sum('duration_in_m'), 'image' => $workoutDayExercises->first()->image ?? null ]);
            $workoutDay['workout_day_exercises'] = $workoutDayExercises;
            $workoutPlanDays[] = $workoutDay;
        }
        $workoutPlan['workout_days'] = $workoutPlanDays;
        return $workoutPlan;
    }

    private function makeExerciseDetails($exerciseFactors, $time)
    {
        return [
            'sets'          => $exerciseFactors['sets'],
            'reps'          => $exerciseFactors['reps'],
            'percentage'    => $exerciseFactors['percentage'],
            'time_in_m'     => $time
        ];
    }

    private function getExerciseGeneralFactors($intensityLevelIndex = null)
    {
        $exerciseIntensityLevel = null;
        if($intensityLevelIndex)
            $exerciseIntensityLevel = Exercise::EXERCISE_INTENSITY_LEVELS[$intensityLevelIndex];

        if(!$exerciseIntensityLevel)
            $exerciseIntensityLevel = collect(Exercise::EXERCISE_INTENSITY_LEVELS)->random();
    
        $exerciseDetails = Exercise::EXERCISE_FACTORS[$exerciseIntensityLevel];
        return $exerciseDetails;
    }
    public function assignWorkoutDayExercises(UserDetail $userDetails, $workoutDayId)
    {
        $workoutPlanDayExercises = [];

        $exercise = $this->exerciseRepository->getExercises(['body_parts' => $userDetails->body_parts, 'equipment_type' => $userDetails->equipment_type]);

        $majorLiftExercises = clone $exercise;
        $accessoryMovementExercises = clone $exercise;
        $cardioExercises = clone $exercise;

        $majorLiftExercises = $majorLiftExercises->where(['exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT])->inRandomOrder()->take(1)->get();
        $accessoryMovementExercises = $accessoryMovementExercises->whereIn('exercise_category_name', Exercise::CATEGORY_ACCESSORY_MOVEMENT_CATEGORIES)->inRandomOrder()->take(2)->get();
        $cardioExercises = $cardioExercises->where(['exercise_category_name' => Exercise::CATEGORY_CARDIO])->inRandomOrder()->take(1)->get();
        $exercises = array_merge($majorLiftExercises->toArray(), $accessoryMovementExercises->toArray(), $cardioExercises->toArray());

        foreach ($exercises as $exercise) {
            $exerciseDetails = $this->getImpectualWorkoutExercisesDetails($userDetails, $exercise['exercise_category_name'], $this->getExerciseGeneralFactors());
            $majorLiftExercisesMaxRep = $exercise['exercise_type_name'];
            $majorLiftExercisesMaxRep ? $majorLiftExercisesMaxRep .='__one_rep_max_in_kg' : null;
            $weightInKg = 0;
            if($majorLiftExercisesMaxRep)
                $weightInKg = calculateByPercentage($userDetails[$majorLiftExercisesMaxRep] ,$exerciseDetails['percentage']);

            $workoutPlanDayExercises[] = WorkoutDayExercise::create([
                'name'                  => $exercise['name'],
                'description'           => $exercise['description'],
                'exercise_category_name'=> $exercise['exercise_category_name'],
                'exercise_type_name'    => $exercise['exercise_type_name'],
                'duration_in_m'         => $exerciseDetails['time_in_m'],
                'sets'                  => $exerciseDetails['sets'],
                'reps'                  => $exerciseDetails['reps'],
                'weight_in_kg'          => $weightInKg,
                'burn_calories'         => $exercise['burn_calories'],

                'image' => $exercise['image'],
                'video' => $exercise['video'],

                'workout_day_id'=> $workoutDayId,
                'exercise_id'   => $exercise['id'],
                'body_part_id'  => $exercise['body_part_id'],
                'status'        => WorkoutDayExercise::STATUS_TODO
            ]);
        }
        return $workoutPlanDayExercises;
    }

    public function getImpectualWorkoutExercisesDetails($userDetails, $exerciseCategory, $exerciseFactors)
    {
        $exercisesDetails = null;
        switch ($userDetails->how_long_time_to_workout) {
            case Option::Q12_OPT1__30_MINS:
                $exercisesDetails = match ($exerciseCategory) {
                    Exercise::CATEGORY_MAJOR_LIFT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_SINGLE_JOINT, Exercise::CATEGORY_MULTI_JOINT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_CARDIO => $this->makeExerciseDetails($exerciseFactors, 16),
                    default => null // TODO : Need to fix when match case falls in default it return null 
                    // and it will return error on assignWorkoutDayExercises function (WorkoutDayExercise creation)
                };
                break;
            case Option::Q12_OPT2__45_MINS:
                $exercisesDetails = match ($exerciseCategory) {
                    Exercise::CATEGORY_MAJOR_LIFT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_SINGLE_JOINT, Exercise::CATEGORY_MULTI_JOINT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_CARDIO => $this->makeExerciseDetails($exerciseFactors, 16),
                    default => null
                };
                break;
            case Option::Q12_OPT3__1_HOUR:
                $exercisesDetails = match ($exerciseCategory) {
                    Exercise::CATEGORY_MAJOR_LIFT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_SINGLE_JOINT, Exercise::CATEGORY_MULTI_JOINT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_CARDIO => $this->makeExerciseDetails($exerciseFactors, 16),
                    default => null
                };
                break;
            case Option::Q12_OPT4__MORE_THAN_1_HOUR:
                $exercisesDetails = match ($exerciseCategory) {
                    Exercise::CATEGORY_MAJOR_LIFT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_SINGLE_JOINT, Exercise::CATEGORY_MULTI_JOINT => $this->makeExerciseDetails($exerciseFactors, 16),
                    Exercise::CATEGORY_CARDIO => $this->makeExerciseDetails($exerciseFactors, 16),
                    default => null
                };
                break;
        }

        return $exercisesDetails;
    }
}
