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
use Error;

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
        $generatedDates = array_merge(...$weekWiseDates);

        if(!count($weekWiseDates) > 0)
            return null;

        /* Mark complete previous workout plan */
        WorkoutPlan::where('user_id', \Auth::id())->update([
            'status' => WorkoutPlan::STATUS_COMPLETED
        ]);

        $randomDates        = [];
        $generatedWeekDates = [];
        foreach ($weekWiseDates as $key => $weekDates) {
            if (count($weekDates) >= $numberOfDaysPerWeek) {
                // $randomDates = array_merge($randomDates, pickRandomIndices($weekDates, $numberOfDaysPerWeek));
                $generatedWeekDates = generateWeekDates($generatedWeekDates, $weekDates, $numberOfDaysPerWeek);
                $randomDates = array_merge($randomDates, $generatedWeekDates);
            }
        }

        $workoutPlan = WorkoutPlan::create([
            'user_id'    => \Auth::id(),
            'name'       => 'Workout Plan',
            'start_date' => $planStartDate, // $randomDates[0],
            'end_date'   => $planEndDate, // $randomDates[count($randomDates) - 1],
            'status'     => WorkoutPlan::STATUS_TODO
        ]);

        // create workout day and workout day exercises
        $workoutPlanDays = [];
        foreach ($generatedDates as $key => $generatedDate) {

            $dayCount = $key + 1;
            $dayNumber = str_pad($dayCount, 2, '0', STR_PAD_LEFT);

            $workoutDay = WorkoutDay::create([
                'workout_plan_id' => $workoutPlan->id,
                'name'            => [
                    'en' => 'Day ' . $dayNumber,
                    'ar' => 'اليوم ' . $dayNumber
                ],
                'description'     => [
                    'en' => WorkoutDay::DESCRIPTION_EN,
                    'ar' => WorkoutDay::DESCRIPTION_AR
                ],
                'date'            => Carbon::parse($generatedDate),
                'status'          => WorkoutDay::STATUS_TODO,
                'duration'        => 0,
                'image'           => null,
            ]);

            $isRestDay = !in_array($generatedDate, $randomDates);
            // if (!$isRestDay) {
                // TODO : assign workoutday exercises
                $workoutDayExercises = collect($this->assignWorkoutDayExercises($userDetails, $workoutDay->id));
                $workoutDay->update(['is_rest_day' => $isRestDay, 'duration' => $workoutDayExercises->sum('duration_in_m'), 'image' => $workoutDayExercises->first()->image ?? null ]);
                $workoutDay['workout_day_exercises'] = $workoutDayExercises;
                $workoutPlanDays[] = $workoutDay;
            // }
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

    public function makeCategorizeExercises($majorLift, $singleJoint, $multiJoint, $cardio)
    {
        return [
            Exercise::CATEGORY_MAJOR_LIFT => $majorLift,
            Exercise::CATEGORY_SINGLE_JOINT => $singleJoint,
            Exercise::CATEGORY_MULTI_JOINT => $multiJoint,
            Exercise::CATEGORY_CARDIO => $cardio
        ];
    }

    public function makeExercisesGrouping($goal, $howLongTimeToWorkout)
    {
        return match ($goal) {

            Option::Q1_OPT1__LOSE_WEIGHT => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->makeCategorizeExercises(1, 0, 0, 1),
                Option::Q12_OPT2__45_MINS => $this->makeCategorizeExercises(1, 1, 0, 1),
                Option::Q12_OPT3__1_HOUR => $this->makeCategorizeExercises(1, 1, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->makeCategorizeExercises(1, 2, 2, 1),
                default => $this->makeCategorizeExercises(1, 0, 0, 1)
            },
            Option::Q1_OPT2__GAIN_WEIGHT => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->makeCategorizeExercises(1, 0, 1, 1),
                Option::Q12_OPT2__45_MINS => $this->makeCategorizeExercises(1, 1, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->makeCategorizeExercises(1, 2, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->makeCategorizeExercises(1, 2, 2, 1),
                default => $this->makeCategorizeExercises(1, 0, 1, 1)
            },
            Option::Q1_OPT3__BUILD_MUSCLE => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->makeCategorizeExercises(1, 1, 0, 1),
                Option::Q12_OPT2__45_MINS => $this->makeCategorizeExercises(1, 1, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->makeCategorizeExercises(1, 2, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->makeCategorizeExercises(1, 3, 2, 1),
                default => $this->makeCategorizeExercises(1, 1, 0, 1)
            },
            Option::Q1_OPT4__GET_FIT => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->makeCategorizeExercises(1, 0, 0, 1),
                Option::Q12_OPT2__45_MINS => $this->makeCategorizeExercises(1, 0, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->makeCategorizeExercises(1, 1, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->makeCategorizeExercises(1, 2, 2, 1),
                default => $this->makeCategorizeExercises(1, 0, 0, 1)
            },
            default => throw new Error('Invalid Goal')
        };
    }

    public function assignWorkoutDayExercises(UserDetail $userDetails, $workoutDayId)
    {
        $workoutPlanDayExercises = [];

        $exercise = $this->exerciseRepository->getExercises(['body_parts' => $userDetails->body_parts, 'equipment_type' => $userDetails->equipment_type]);

        $majorLiftExercises = clone $exercise;
        $singleJointExercises = clone $exercise;
        $multiJointExercises = clone $exercise;
        $cardioExercises = clone $exercise;

        $exercisesCounts = $this->makeExercisesGrouping($userDetails->goal, $userDetails->how_long_time_to_workout);

        $majorLiftExercises = $majorLiftExercises->where(['exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT])->inRandomOrder()->take($exercisesCounts[Exercise::CATEGORY_MAJOR_LIFT])->get();
        $singleJointExercises = $singleJointExercises->where('exercise_category_name', Exercise::CATEGORY_SINGLE_JOINT)->inRandomOrder()->take($exercisesCounts[Exercise::CATEGORY_SINGLE_JOINT])->get();
        $multiJointExercises = $multiJointExercises->where('exercise_category_name', Exercise::CATEGORY_MULTI_JOINT)->inRandomOrder()->take($exercisesCounts[Exercise::CATEGORY_MULTI_JOINT])->get();
        $accessoryMovementExercises = array_merge($singleJointExercises->toArray(), $multiJointExercises->toArray());

        $cardioExercises = $cardioExercises->where(['exercise_category_name' => Exercise::CATEGORY_CARDIO])->inRandomOrder()->take($exercisesCounts[Exercise::CATEGORY_CARDIO])->get();
        $exercises = array_merge($majorLiftExercises->toArray(), $accessoryMovementExercises, $cardioExercises->toArray());

        $exerciseGeneralFactors = $this->getExerciseGeneralFactors();
        foreach ($exercises as $exercise) {
            $exerciseDetails = $this->getImpectualWorkoutExercisesDetails($userDetails, $exercise['exercise_category_name'], $exerciseGeneralFactors);
            $majorLiftExercisesMaxRep = $exercise['exercise_type_name'];
            $majorLiftExercisesMaxRep ? $majorLiftExercisesMaxRep .='__one_rep_max_in_kg' : null;
            $weightInKg = 0;
            if($majorLiftExercisesMaxRep)
                $weightInKg = calculateByPercentage($userDetails[$majorLiftExercisesMaxRep] ,$exerciseDetails['percentage']);

            $workoutPlanDayExercises[] = WorkoutDayExercise::create([
                'name'                  => $exercise['name'],
                'description'           => $exercise['description'],
                'is_finisher'           => $exercise['is_finisher'],
                'exercise_category_name'=> $exercise['exercise_category_name'],
                'exercise_type_name'    => $exercise['exercise_type_name'],
                'duration_in_m'         => $exerciseDetails['time_in_m'],
                'sets'                  => $exerciseDetails['sets'],
                'reps'                  => $exerciseDetails['reps'],
                'weight_in_kg'          => $weightInKg,
                'burn_calories'         => $exercise['burn_calories'],

                'image' => $exercise['image'],
                'audio' => $exercise['audio'],
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
