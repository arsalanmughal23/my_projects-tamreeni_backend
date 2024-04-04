<?php

namespace App\Repositories;

use App\Models\Meal;
use App\Models\NutritionPlan;
use App\Models\NutritionPlanDay;
use App\Models\NutritionPlanDayMeal;
use App\Models\Option;
use App\Repositories\BaseRepository;

/**
 * Class NutritionPlanRepository
 * @package App\Repositories
 * @version April 3, 2024, 9:53 am UTC
 */
class NutritionPlanRepository extends BaseRepository
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
        return NutritionPlan::class;
    }

    public function generateNutritionPlan($user)
    {
        /* Mark complete previous nutrition plan */
        NutritionPlan::where('user_id', \Auth::id())->update([
            'status' => NutritionPlan::STATUS_COMPLETED
        ]);
        /* TODO: need to confirm this with PM how long it will be, currently using same as workout plan */
        $numberOfDaysPerWeek = Option::$DAYS_PER_WEEK[$user->workout_days_in_a_week] ?? 0;
        $weekWiseDates       = generateDatesByWeek(date('Y-m-d'), $user->reach_goal_target_date);
        $randomDates         = [];
        foreach ($weekWiseDates as $key => $weekDates) {
            if (count($weekDates) >= $numberOfDaysPerWeek) {
                $randomDates = array_merge($randomDates, pickRandomIndices($weekDates, $numberOfDaysPerWeek));
            }
        }
        $nutritionPlan = NutritionPlan::create([
            'user_id'    => \Auth::id(),
            'name'       => 'Nutrition Plan',
            'start_date' => $randomDates[0],
            'end_date'   => $randomDates[count($randomDates) - 1],
            'status'     => NutritionPlan::STATUS_TODO

        ]);
        /* TODO: get meals through algo */
        $meals = Meal::all();
        $this->assignNutritionPlanDaysAndMeals($randomDates, $meals, $nutritionPlan->id);
        return $nutritionPlan;
    }

    public function assignNutritionPlanDaysAndMeals($randomDates, $meals, $nutritionPlanId)
    {
        foreach ($randomDates as $key => $randomDate) {
            $nutritionPlanDay = NutritionPlanDay::create([
                'nutrition_plan_id' => $nutritionPlanId,
                'name'              => [
                    'en' => 'Day 0' . $key + 1,
                    'ar' => 'اليوم 0' . $key + 1
                ],
                'date'              => $randomDate,
                'status'            => NutritionPlanDay::STATUS_TODO
            ]);
            foreach ($meals as $index => $meal) {
                NutritionPlanDayMeal::create([
                    'nutrition_plan_day_id' => $nutritionPlanDay->id,
                    'meal_id'               => $meal->id,
                    'meal_type_id'          => $meal->meal_type_id,
                    'calories'              => $meal->calories,
                    'carbs'                 => $meal->carbs,
                    'fats'                  => $meal->fats,
                    'protein'               => $meal->protein,
                    'status'                => NutritionPlanDayMeal::STATUS_TODO
                ]);
            }
        }
    }
}
