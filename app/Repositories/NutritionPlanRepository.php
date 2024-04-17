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
        $meals = Meal::whereBetween('calories', [10, 1000])->inRandomOrder()->get()->unique('meal_type_id');
        $nutritionPlan['nutrition_plan_days'] = $this->assignNutritionPlanDaysAndMeals($randomDates, $meals, $nutritionPlan->id);
        return $nutritionPlan;
    }

    public function assignNutritionPlanDaysAndMeals($randomDates, $meals, $nutritionPlanId)
    {
        $nutritionPlanDays = [];
        foreach ($randomDates as $key => $randomDate) {
            $nutritionPlanDay = NutritionPlanDay::create([
                'nutrition_plan_id' => $nutritionPlanId,
                'name'              => $key + 1,
                'date'              => $randomDate,
                'status'            => NutritionPlanDay::STATUS_TODO
            ]);

            $nutritionPlanDayMeals = [];
            foreach ($meals as $index => $meal) {
                $nutritionPlanDayMeal = NutritionPlanDayMeal::create([
                    'nutrition_plan_day_id' => $nutritionPlanDay->id,
                    'meal_id'               => $meal->id,
                    'meal_type_id'          => $meal->meal_type_id,
                    'calories'              => $meal->calories,
                    'carbs'                 => $meal->carbs,
                    'fats'                  => $meal->fats,
                    'protein'               => $meal->protein,
                    'status'                => NutritionPlanDayMeal::STATUS_TODO
                ]);
                array_push($nutritionPlanDayMeals, $nutritionPlanDayMeal);
            }
            $nutritionPlanDay['nutrition_plan_day_meals'] = $nutritionPlanDayMeals;
            array_push($nutritionPlanDays, $nutritionPlanDay);
        }
        return $nutritionPlanDays;
    }

    public function getUserActiveNutritionPlanByDate($user_id, $date = null)
    {
        !$date && $date = now()->format('Y-m-d');
        return NutritionPlan::where('user_id', $user_id)
                    // Need to UnComment when Cron Is Applying
                    // ->where('status', NutritionPlan::STATUS_IN_PROGRESS)
                    ->where('start_date', '<=', $date)
                    ->where('end_date', '>=', $date)
                    ->first();
    }
}
