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
        private ExerciseBreakdownRepository $exerciseBreakdownRepository,
        private BodyPartRepository $bodyPartRepository,
        private $assignableExercisesBodypartSlugs = [],
        private $assignableFinisherExercisesBodypartSlugs = [],
        private $assignableBodypart = null,
        private $assignableFinisherBodypart = null
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
        $dayNumber = 1;
        $weekNumber = 1;
        $weekDayNumber = 0;

        foreach ($generatedDates as $key => $generatedDate) {

            $dayNumber = $key + 1;
            $dayNumberFormated = str_pad($dayNumber, 2, '0', STR_PAD_LEFT);

            $lastWorkoutDate = collect($workoutPlanDays)?->last()?->date ?? null;
            $nextWeekStartDay = $lastWorkoutDate?->addWeek()?->startOfWeek() ?? null;
            $nextWeekStartDay2 = $nextWeekStartDay ? (clone $nextWeekStartDay)?->addDay(1) : null;
            $generatedDateCarbon = Carbon::parse($generatedDate);

            if($generatedDateCarbon?->between($nextWeekStartDay, $nextWeekStartDay2)){
                $weekNumber++;
                $weekDayNumber = 0;
            }

            $weekDayNumber++;

            $workoutPlan->refresh();
            $workoutDay = WorkoutDay::create([
                'workout_plan_id'   => $workoutPlan->id,
                'day_number'        => $dayNumber,
                'week_number'       => $weekNumber,
                'week_day_number'   => $weekDayNumber,
                'name'  => [
                    'en' => 'Day ' . $dayNumberFormated,
                    'ar' => 'اليوم ' . $dayNumberFormated
                ],
                'description'     => [
                    'en' => WorkoutDay::DESCRIPTION_EN,
                    'ar' => WorkoutDay::DESCRIPTION_AR
                ],
                'date'            => $generatedDateCarbon,
                'status'          => WorkoutDay::STATUS_TODO,
                'duration'        => 0,
                'image'           => null,
            ]);

            if (!count($this->assignableExercisesBodypartSlugs)) {
                $this->assignableExercisesBodypartSlugs = $this->bodyPartRepository->pluck('slug');

                $this->assignableBodypart = collect($this->assignableExercisesBodypartSlugs)->random();
                collect($this->assignableExercisesBodypartSlugs)->reject(fn ($bodyPart) => $bodyPart == $this->assignableBodypart);
            }

            if(!count($this->assignableFinisherExercisesBodypartSlugs)) {
                $this->assignableFinisherExercisesBodypartSlugs = $userDetails->body_parts;

                $this->assignableFinisherBodypart = collect($this->assignableFinisherExercisesBodypartSlugs)->random();
                collect($this->assignableFinisherExercisesBodypartSlugs)->reject(fn ($bodyPart) => $bodyPart == $this->assignableFinisherBodypart);
            }

            $isRestDay = !in_array($generatedDate, $randomDates);
            if (!$isRestDay) {
                $this->assignableBodypart = collect($this->assignableExercisesBodypartSlugs)->random();
                collect($this->assignableExercisesBodypartSlugs)->reject(fn ($bodyPart) => $bodyPart == $this->assignableBodypart);

                $this->assignableFinisherBodypart = collect($this->assignableFinisherExercisesBodypartSlugs)->random();
                collect($this->assignableFinisherExercisesBodypartSlugs)->reject(fn ($bodyPart) => $bodyPart == $this->assignableFinisherBodypart);
            }

            // if (!$isRestDay) {
                $workoutDayExercises = collect($this->assignWorkoutDayExercises($userDetails, $workoutDay, $workoutPlan));
                $workoutDayExercisesDuration = $workoutDayExercises->whereIn('exercise_category_name', [
                        Exercise::CATEGORY_MAJOR_LIFT, Exercise::CATEGORY_SINGLE_JOINT, Exercise::CATEGORY_MULTI_JOINT
                    ])->sum('duration_in_m');

                $workoutDay->update(['is_rest_day' => $isRestDay, 'duration' => $workoutDayExercisesDuration, 'image' => $workoutDayExercises->first()->image ?? null ]);
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

    public function assignWorkoutDayExercises(UserDetail $userDetails, WorkoutDay $workoutDay, WorkoutPlan $workoutPlan)
    {
        $workoutDayId = $workoutDay->id;
        $workoutPlanDayExercises = [];

        // Workout-Plan All Days Exercises
        // $workoutPlanDaysExercises = $workoutPlan->workoutPlanDaysExercises;

        // Current Week
        $currentWeekStartDate = \Carbon\Carbon::parse($workoutDay->date)->startOfWeek()->format('Y-m-d');
        $currentWeekEndDate = \Carbon\Carbon::parse($workoutDay->date)->endOfWeek()->format('Y-m-d');

        $workoutPlanDays = WorkoutDay::where('workout_plan_id', $workoutPlan->id);
        $workoutPlanCurrentWeekDays = clone $workoutPlanDays; // $workoutPlan->workoutPlanDays;
        $workoutPlanCurrentWeekDays = $workoutPlanCurrentWeekDays->whereBetween('date', [$currentWeekStartDate, $currentWeekEndDate]);

        // Previous Week
        $previousWeekStartDate = \Carbon\Carbon::parse($workoutDay->date)->subWeek()->startOfWeek()->format('Y-m-d');
        $previousWeekEndDate = \Carbon\Carbon::parse($workoutDay->date)->subWeek()->endOfWeek()->format('Y-m-d');

        $workoutPlanPreviousWeekDays = clone $workoutPlanDays; // $workoutPlan->workoutPlanDays;
        $workoutPlanPreviousWeekDays = $workoutPlanPreviousWeekDays->whereBetween('date', [$previousWeekStartDate, $previousWeekEndDate]);
        $workoutPlanCurrentWeekDaysIds = $workoutPlanCurrentWeekDays->pluck('id');
        $workoutPlanCurrentWeekExercises = WorkoutDayExercise::whereIn('workout_day_id', $workoutPlanCurrentWeekDaysIds)->get();

        $currentWeekCardioExercises = $workoutPlanCurrentWeekExercises->filter(function($workoutExercise){
            return $workoutExercise->exercise_category_name == Exercise::CATEGORY_CARDIO;
        });

        // $exercise = $this->exerciseRepository->getExercises(['body_parts' => $userDetails->body_parts, 'equipment_type' => $userDetails->equipment_type]);
        $exercise = $this->exerciseRepository->getExercises(['body_parts' => $this->assignableBodypart, 'equipment_type' => $userDetails->equipment_type, 'is_finisher' => false]);
        $finisherExercises = $this->exerciseRepository->getExercises([
                                    'body_parts' => $this->assignableFinisherBodypart,
                                    'equipment_type' => $userDetails->equipment_type,
                                    'is_finisher' => true
                                ])
                                ->inRandomOrder()->take(1)->get();

        $majorLiftExercises = clone $exercise;
        $singleJointExercises = clone $exercise;
        $multiJointExercises = clone $exercise;

        $cardioExercises = clone $exercise;

        $exerciseBreakdownCollection = $this->exerciseBreakdownRepository->where(['goal' => $userDetails->goal, 'how_long_time_to_workout' => $userDetails->how_long_time_to_workout]);
        $majorLiftExerciseBreakdown = clone $exerciseBreakdownCollection;
        $singleJointExerciseBreakdown = clone $exerciseBreakdownCollection;
        $multiJointExerciseBreakdown = clone $exerciseBreakdownCollection;
        $cardioExerciseBreakdown = clone $exerciseBreakdownCollection;

        $majorLiftExerciseBreakdown = $majorLiftExerciseBreakdown->where('exercise_category', Exercise::CATEGORY_MAJOR_LIFT)->first();
        $singleJointExerciseBreakdown = $singleJointExerciseBreakdown->where('exercise_category', Exercise::CATEGORY_SINGLE_JOINT)->first();
        $multiJointExerciseBreakdown = $multiJointExerciseBreakdown->where('exercise_category', Exercise::CATEGORY_MULTI_JOINT)->first();
        $cardioExerciseBreakdown = $cardioExerciseBreakdown->where('exercise_category', Exercise::CATEGORY_CARDIO)->first();


        $majorLiftExercises = $majorLiftExercises->where(['exercise_category_name' => Exercise::CATEGORY_MAJOR_LIFT])->inRandomOrder()->take($majorLiftExerciseBreakdown?->exercise_count ?? 0)->get();
        $singleJointExercises = $singleJointExercises->where('exercise_category_name', Exercise::CATEGORY_SINGLE_JOINT)->inRandomOrder()->take($singleJointExerciseBreakdown?->exercise_count ?? 0)->get();
        $multiJointExercises = $multiJointExercises->where('exercise_category_name', Exercise::CATEGORY_MULTI_JOINT)->inRandomOrder()->take($multiJointExerciseBreakdown?->exercise_count ?? 0)->get();
        $accessoryMovementExercises = array_merge($singleJointExercises->toArray(), $multiJointExercises->toArray());

        if($currentWeekCardioExercises->count()){
            $cardioExercises = collect();
        }
        else {
            $cardioExercises = $cardioExercises->where(['exercise_category_name' => Exercise::CATEGORY_CARDIO])
                                    ->inRandomOrder()->take($cardioExerciseBreakdown?->exercise_count ?? 0)->get();
        }

        $exerciseBreakdownCollection = $exerciseBreakdownCollection->get();
        $exercises = array_merge($majorLiftExercises->toArray(), $accessoryMovementExercises, $cardioExercises->toArray(), $finisherExercises->toArray());
        $majorLiftWeightPercentage = 20 + ($workoutDay->week_number * 10);

        foreach ($exercises as $index => $exercise) {

            $exerciseBreakdown = $exerciseBreakdownCollection->filter(function($eachExercise) use($exercise) {
                return $eachExercise->exercise_category == $exercise['exercise_category_name'];
            });
            $exerciseBreakdown = $exerciseBreakdown->first();

            if(!$exerciseBreakdown?->exercise_count)
                continue;

            $majorLiftExercisesMaxRep = $exercise['exercise_type_name'];
            $majorLiftExercisesMaxRep ? $majorLiftExercisesMaxRep .='__one_rep_max_in_kg' : null;
            $weightInKg = 0;

            if ($majorLiftExercisesMaxRep) {
                if($majorLiftWeightPercentage < 100)
                    $weightInKg = calculateByPercentage($userDetails[$majorLiftExercisesMaxRep], $majorLiftWeightPercentage);
                else
                    $weightInKg = $userDetails[$majorLiftExercisesMaxRep];
            }

            $exerciseTime = explode('-', str_replace('m', '', $exerciseBreakdown['time'] ?? '0'));
            $exerciseTime = end($exerciseTime);

            $workoutPlanDayExercises[] = WorkoutDayExercise::create([
                'name'                  => $exercise['name'],
                'description'           => $exercise['description'],
                'is_finisher'           => $exercise['is_finisher'],
                'exercise_category_name'=> $exercise['exercise_category_name'],
                'exercise_type_name'    => $exercise['exercise_type_name'],
                'duration_in_m'         => $exerciseTime,
                'duration'              => $exerciseBreakdown['time'],
                'sets'                  => $exerciseBreakdown['sets'],
                'reps'                  => $exerciseBreakdown['reps'],
                'weight_in_kg'          => round($weightInKg),
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

    public function setExerciseDetails($majorLift, $singleJoint, $multiJoint, $cardio)
    {
        return [
            Exercise::CATEGORY_MAJOR_LIFT => $majorLift,
            Exercise::CATEGORY_SINGLE_JOINT => $singleJoint,
            Exercise::CATEGORY_MULTI_JOINT => $multiJoint,
            Exercise::CATEGORY_CARDIO => $cardio
        ];
    }
    // getExerciseSetRepTimeWeight
    public function getExerciseBreakdown($goal, $howLongTimeToWorkout)
    {
        return match ($goal) {

            Option::Q1_OPT1__LOSE_WEIGHT => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->setExerciseDetails(1, 1, 0, 1, 1),
                Option::Q12_OPT2__45_MINS => $this->setExerciseDetails(1, 1, 1, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->setExerciseDetails(1, 2, 1, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->setExerciseDetails(1, 3, 2, 1, 1),
                default => $this->setExerciseDetails(1, 1, 0, 1, 1)
            },
            // GET STRONGER
            Option::Q1_OPT2__GAIN_WEIGHT => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->setExerciseDetails(1, 0, 1, 1, 1),
                Option::Q12_OPT2__45_MINS => $this->setExerciseDetails(1, 1, 1, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->setExerciseDetails(1, 2, 1, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->setExerciseDetails(1, 2, 2, 1, 1),
                default => $this->setExerciseDetails(1, 0, 1, 1, 1)
            },
            Option::Q1_OPT3__BUILD_MUSCLE => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->setExerciseDetails(1, 1, 0, 1, 1),
                Option::Q12_OPT2__45_MINS => $this->setExerciseDetails(1, 1, 1, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->setExerciseDetails(1, 2, 1, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->setExerciseDetails(1, 3, 2, 1, 1),
                default => $this->setExerciseDetails(1, 1, 0, 1, 1)
            },
            Option::Q1_OPT4__GET_FIT => match ($howLongTimeToWorkout) {
                Option::Q12_OPT1__30_MINS => $this->setExerciseDetails(1, 0, 0, 1, 1),
                Option::Q12_OPT2__45_MINS => $this->setExerciseDetails(1, 0, 1, 1, 1),
                Option::Q12_OPT3__1_HOUR => $this->setExerciseDetails(1, 1, 1, 1, 1),
                Option::Q12_OPT4__MORE_THAN_1_HOUR => $this->setExerciseDetails(1, 2, 2, 1, 1),
                default => $this->setExerciseDetails(1, 0, 0, 1, 1)
            },
            default => throw new Error('Invalid Goal')
        };
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
