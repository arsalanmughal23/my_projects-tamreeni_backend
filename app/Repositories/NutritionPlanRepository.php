<?php

namespace App\Repositories;

use App\Models\MealBreakdown;
use App\Models\MealType;
use App\Models\NutritionPlan;
use App\Models\NutritionPlanDay;
use App\Models\NutritionPlanDayMeal;
use App\Models\UserDetail;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class NutritionPlanRepository
 * @package App\Repositories
 * @version April 3, 2024, 9:53 am UTC
 */
class NutritionPlanRepository extends BaseRepository
{
    public function __construct(
        private MealRepository $mealRepository,
        private RecipeRepository $recipeRepository,
        private MealBreakdownRepository $mealBreakdownRepository,
        private NutritionPlanDayRecipeRepository $nutritionPlanDayRecipeRepository,
        private NplanDayRecipeIngredientRepository $nplanDayRecipeIngredientRepository,
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
        return NutritionPlan::class;
    }

    public function generateNutritionPlan(UserDetail $userDetails, Carbon $planStartDate, Carbon $planEndDate)
    {
        // Generate Upcomming Days (Dates) by weekly grouping
        $weekWiseDates  = generateDatesByWeek($planStartDate, $planEndDate);
        if(!count($weekWiseDates) > 0)
            return null;

        /* Mark complete previous nutrition plan */
        NutritionPlan::where('user_id', \Auth::id())->update([
            'status' => NutritionPlan::STATUS_COMPLETED
        ]);

        $randomDates    = [];
        // Set All Upcomming Days Dates in an array from all weeks
        foreach ($weekWiseDates as $key => $weekDates) {
            $randomDates = array_merge($randomDates, $weekDates);
        }

        // Create New Nutrition Plan
        $nutritionPlan = NutritionPlan::create([
            'user_id'    => \Auth::id(),
            'name'       => 'Nutrition Plan',
            'start_date' => $randomDates[0],
            'end_date'   => $randomDates[count($randomDates) - 1],
            'status'     => NutritionPlan::STATUS_TODO
        ]);

        
        $mealBreakdown = $this->mealBreakdownRepository->getMealBreakdowns([
                'diet_type' => $userDetails->diet_type,
                'total_calories' => $userDetails->algo_required_calories
            ])
            ->inRandomOrder()->first();

        if(!$mealBreakdown)
            return $nutritionPlan;

        $nutritionPlanDays = [];
        // Create Nutrition Plan Days & Assign Meals on every each Day
        foreach ($randomDates as $key => $randomDate) {
            $randomDate = Carbon::parse($randomDate);

            // Create Nutrition Plan Day
            $nutritionPlanDay = NutritionPlanDay::create([
                'nutrition_plan_id' => $nutritionPlan->id,
                'name'              => $key + 1,
                'date'              => $randomDate,
                'status'            => NutritionPlanDay::STATUS_TODO
            ]);

            // Assign Meals on Each Nutrition Plan Day
            // $nutritionPlanDayMeals = $this->assignMealsOnNutritionPlanDay($userDetails, $nutritionPlanDay, $randomDate);
            // $nutritionPlanDay['nutrition_plan_day_meals'] = $nutritionPlanDayMeals;

            // Assign Recipes on Each Nutrition Plan Day
            $nutritionPlanDayRecipes = $this->assignRecipesOnNutritionPlanDay($userDetails, $nutritionPlanDay, $mealBreakdown, $randomDate);
            $nutritionPlanDay['nutrition_plan_day_recipes'] = $nutritionPlanDayRecipes;

            // Push Nutrition Plan Day into their listing array
            array_push($nutritionPlanDays, $nutritionPlanDay);
        }
        // Set All Nutrition Plan Days in Nutrition Plan Data
        $nutritionPlan['nutrition_plan_days'] = $nutritionPlanDays;
        return $nutritionPlan;
    }

    public function getRemainingMealTimes(Carbon $dateTime)
    {
        $dayRemainingMealTimes = [];
        // Add Breakfast into array list if current time is before 11:00 AM UTC
        if($dateTime <  now()->setTime(11,0))//11:00 AM UTC
            array_push($dayRemainingMealTimes, MealType::NAME_BREAKFAST);

        // Add Lunch into array list if current time is before 04:00 AM UTC
        if($dateTime <  now()->setTime(16,0))//04:00 PM UTC
            array_push($dayRemainingMealTimes, MealType::NAME_LUNCH);

        // Add Fruit & Snack into array list if current time is before 05:00 AM UTC
        if($dateTime <  now()->setTime(17,0))//05:00 PM UTC
            $dayRemainingMealTimes = array_merge($dayRemainingMealTimes, [MealType::NAME_FRUIT, MealType::NAME_SNACK]);

        // Add Dinner into array list if current time is before 10:00 AM UTC
        if($dateTime <  now()->setTime(22,0))//10:00 PM UTC
            array_push($dayRemainingMealTimes, MealType::NAME_DINNER);

        // Return list of Remaining Meal Times
        return $dayRemainingMealTimes;
    }

    public function assignRecipesOnNutritionPlanDay(UserDetail $userDetails, NutritionPlanDay $nutritionPlanDay, $mealBreakdown, Carbon $planDayDateTime)
    {
        $requiredCalories = $userDetails->algo_required_calories ?? 0;
        $nutritionPlanDayRecipes = [];

        foreach(MealType::ALL_NAMES as $mealType) {
            // Check Plan Day Date is Today's Date
            if($planDayDateTime->isToday()){
                // Get Today's Remaining Meal Times
                $todayRemainingMealTimes = $this->getRemainingMealTimes($planDayDateTime);

                // Skip this iteration when mealType is not exists in Remaining Meal Type
                // Use Case: if lunch time is passed away no need to assign lunch or before meals
                if(!in_array($mealType, $todayRemainingMealTimes))
                    continue;
            }

            // TODO : Need to Improve NutritionPlan Algo
            $recipeUnits = $mealBreakdown[$mealType.'_units'] ?? 0;

            // Get Recipe according to the Questionnaire and their algo
            $recipe = $this->recipeRepository->getRecipes([
                // 'calories' => $mealTypeMealRequiredCalories,
                'units_in_recipe' => $recipeUnits,
                'meal_type' => $mealType,
                'diet_type' => $userDetails->diet_type,
                'meal_category_slugs' => $userDetails->food_preferences,
            ])
            ->inRandomOrder()->first();

            // Skip iteration when meal is not found
            if(!$recipe)
                continue;

            $recipeData = array_merge($recipe->toArray(), ['recipe_id' => $recipe->id]);
            $nutritionPlanDayRecipe = $nutritionPlanDay->nutritionPlanDayRecipes()->create($recipeData);

            $recipeIngredients = $recipe?->recipeIngredients;

            if(!$recipeIngredients)
                continue;


            $nPlanDayRecipeIngredients = [];
            // Add Multiple Recipe Ingredients on Nutrition Plan Recipe 
            foreach ($recipeIngredients as $recipeIngredient) {

                // Calculate Scaled Quantity According to the formula that given by client
                // ingredient-quantity / units-in-recipe * no-of-units

                // TODO : Need to fix this
                $recipeScaledQuantity = $this->calculateRecipeIngredientScaledQuantity($recipe->units_in_recipe ?? 1, $recipeIngredient->quantity ?? 0);

                $nutritionPlanDayRecipeIngredient = array_merge([
                    'scaled_unit' => $recipeIngredient->unit,
                    'scaled_quantity' => $recipeScaledQuantity
                ], $recipeIngredient->toArray());

                // Save Nutrition Plan Day Recipe Ingredient associated with Nutrition Plan Day Recipe
                $nutritionPlanDayRecipeIngredient = $nutritionPlanDayRecipe?->nPlanDayRecipeIngredients()->create($nutritionPlanDayRecipeIngredient);

                // Push Added Recipe Ingredient on $nPlanDayRecipeIngredients
                array_push($nPlanDayRecipeIngredients, $nutritionPlanDayRecipeIngredient);
            }

            $nutritionPlanDayRecipe['nPlanDayRecipeIngredients'] = $nPlanDayRecipeIngredients;
            $nutritionPlanDayRecipe->mealCategories()->sync($nutritionPlanDayRecipe->meal_category_ids);

            // Push Nutrition Plan Day Recipe into their listing array
            array_push($nutritionPlanDayRecipes, $nutritionPlanDayRecipe);
        }
        // Retrun list of Nutrition Plan Day Recipes
        return $nutritionPlanDayRecipes;
    }

    public function calculateRecipeIngredientScaledQuantity(int|float $totalUnits, int $quantity):int
    {
        // // ingredient-quantity / units-in-recipe * no-of-units
        // $totalUnitsInRecipe = $recipe->units_in_recipe * $recipeUnits;
        // $recipeIngredientQuantity = $recipeIngredient->quantity ?? 0;
        // $recipeScaledQuantity = ($totalUnitsInRecipe > 0) ? $recipeIngredientQuantity / $totalUnitsInRecipe : $recipeIngredient->quantity;

        $recipeIngredientQuantity = $quantity ?? 0;
        $recipeScaledQuantity = ($totalUnits > 0) ? $recipeIngredientQuantity / $totalUnits : $recipeIngredientQuantity;
        return $recipeScaledQuantity;
    }

    public function assignMealsOnNutritionPlanDay(UserDetail $userDetails, NutritionPlanDay $nutritionPlanDay, Carbon $planDayDateTime)
    {
        $requiredCalories = $userDetails->algo_required_calories ?? 0;
        $nutritionPlanDayMeals = [];

        foreach(MealType::ALL_NAMES as $mealType) {
            // Check Plan Day Date is Today's Date
            if($planDayDateTime->isToday()){
                // Get Today's Remaining Meal Times
                $todayRemainingMealTimes = $this->getRemainingMealTimes($planDayDateTime);

                // Skip this iteration when mealType is not exists in Remaining Meal Type
                // Use Case: if lunch time is passed away no need to assign lunch or before meals
                if(!in_array($mealType, $todayRemainingMealTimes))
                    continue;
            }

            // Get Meal according to the Questionnaire and their algo
            $meal = $this->mealRepository->getMeals([
                    'meal_type' => $mealType,
                    // 'calories' => $requiredCalories,
                    'diet_type' => $userDetails->diet_type,
                    // 'food_preferences' => $userDetails->food_preferences,
                ])
                ->inRandomOrder()->first();

            // Skip iteration when meal is not found
            if(!$meal)
                continue;

            $mealName = null;
            $mealDescription = null;
            $mealCalories = null;
            switch ($mealType) {
                case MealType::NAME_BREAKFAST :
                    $mealName = $meal->name;
                    $mealDescription = '2 units of ' . $meal->name;
                    $mealCalories = 200;
                    break;
                    
                case MealType::NAME_LUNCH :
                    $mealName = $meal->name . ' + (Raw vegetables)';
                    $mealDescription = '4 units of ' . $meal->name . ' & 1 unit of Raw vegetables';
                    $mealCalories = 450;
                    break;
                    
                case MealType::NAME_DINNER :
                    $mealName = $meal->name . ' + (Cooked vegetables)';
                    $mealDescription = '3 units of ' . $meal->name . ' & 1 unit of Cooked vegetables';
                    $mealCalories = 350;
                    break;
                    
                default :
                    $mealName = $meal->name;
                    $mealDescription = '1 units of ' . $meal->name;
                    $mealCalories = 50;
                    break;
            }
            // Create Nutrition Plan Day Meal
            // OR Assign each Meal on Nutrition Plan Day
            $nutritionPlanDayMeal = NutritionPlanDayMeal::create([
                'nutrition_plan_day_id' => $nutritionPlanDay->id,
                'meal_id'               => $meal->id,
                'meal_type_id'          => $meal->meal_type_id,
                'meal_category_id'      => $meal->meal_category_id,
                'name'                  => $mealName,
                'description'           => $mealDescription,
                'diet_type'             => $meal->diet_type,
                'image'                 => $meal->image,
                'calories'              => $mealCalories,
                'carbs'                 => $meal->carbs,
                'fats'                  => $meal->fats,
                'protein'               => $meal->protein,
                'status'                => NutritionPlanDayMeal::STATUS_TODO
            ]);

            // Push Nutrition Plan Day Meal into their listing array
            array_push($nutritionPlanDayMeals, $nutritionPlanDayMeal);
        }
        // Retrun list of Nutrition Plan Day Meals
        return $nutritionPlanDayMeals;
    }

    public function bkup__assignMealsOnNutritionPlanDay(UserDetail $userDetails, NutritionPlanDay $nutritionPlanDay, Carbon $planDayDateTime)
    {
        $requiredCalories = $userDetails->algo_required_calories ?? 0;
        $nutritionPlanDayMeals = [];

        foreach(MealType::ALL_NAMES as $mealType) {
            // Check Plan Day Date is Today's Date
            if($planDayDateTime->isToday()){
                // Get Today's Remaining Meal Times
                $todayRemainingMealTimes = $this->getRemainingMealTimes($planDayDateTime);

                // Skip this iteration when mealType is not exists in Remaining Meal Type
                // Use Case: if lunch time is passed away no need to assign lunch or before meals
                if(!in_array($mealType, $todayRemainingMealTimes))
                    continue;
            }

            // Get Meal according to the Questionnaire and their algo
            $meal = $this->mealRepository->getMeals([
                    'meal_type' => $mealType,
                    'calories' => $requiredCalories,
                    'diet_type' => $userDetails->diet_type,
                    'food_preferences' => $userDetails->food_preferences,
                ])
                ->inRandomOrder()->first();

            // Skip iteration when meal is not found
            if(!$meal)
                continue;

            // Create Nutrition Plan Day Meal
            // OR Assign each Meal on Nutrition Plan Day
            $nutritionPlanDayMeal = NutritionPlanDayMeal::create([
                'nutrition_plan_day_id' => $nutritionPlanDay->id,
                'meal_id'               => $meal->id,
                'meal_type_id'          => $meal->meal_type_id,
                'meal_category_id'      => $meal->meal_category_id,
                'name'                  => $meal->name,
                'description'           => $meal->description,
                'diet_type'             => $meal->diet_type,
                'image'                 => $meal->image,
                'calories'              => $meal->calories,
                'carbs'                 => $meal->carbs,
                'fats'                  => $meal->fats,
                'protein'               => $meal->protein,
                'status'                => NutritionPlanDayMeal::STATUS_TODO
            ]);

            // Push Nutrition Plan Day Meal into their listing array
            array_push($nutritionPlanDayMeals, $nutritionPlanDayMeal);
        }
        // Retrun list of Nutrition Plan Day Meals
        return $nutritionPlanDayMeals;
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
