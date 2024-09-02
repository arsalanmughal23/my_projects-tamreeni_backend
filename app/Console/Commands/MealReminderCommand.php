<?php

namespace App\Console\Commands;

use App\Constants\NotificationServiceTemplateNames;
use App\Models\MealType;
use App\Models\NutritionPlan;
use App\Models\NutritionPlanDay;
use App\Models\NutritionPlanDayRecipe;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MealReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meal:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recipe (Meal) Reminder & Update Nutrition-Plan / Nutrition-Plan-Day / Nutrition-Plan-Day-Recipe Statuses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::alert($this->signature . ' | '. now()->format('d-M H:i:s'));
        $nowDateTime = clone $date = Carbon::now()->setSecond();
        $dateTimeStartOfDay = $date->startOfDay();

        // MODULE: NutritionPlan
        // Mark Todo Status as In-Progress of the NutritionPlan
        NutritionPlan::where('start_date', $dateTimeStartOfDay)
            ->where('status', NutritionPlan::STATUS_TODO)
            ->update(['status' => NutritionPlan::STATUS_IN_PROGRESS]);

        // Mark In-Progress Status as Completed of the NutritionPlan
        NutritionPlan::where('end_date', $dateTimeStartOfDay->subDay())
            ->where('status', NutritionPlan::STATUS_IN_PROGRESS)
            ->update(['status' => NutritionPlan::STATUS_COMPLETED]);

        // MODULE: NutritionPlanDay
        // Mark Todo Status as In-Progress of the NutritionPlanDay
        NutritionPlanDay::where('date', $dateTimeStartOfDay)
            ->where('status', NutritionPlanDay::STATUS_TODO)
            ->update(['status' => NutritionPlanDay::STATUS_IN_PROGRESS]);

        // Mark In-Progress Status as Completed of the NutritionPlanDay
        NutritionPlanDay::where('date', $dateTimeStartOfDay->subDay())
            ->where('status', NutritionPlanDay::STATUS_IN_PROGRESS)
            ->update(['status' => NutritionPlanDay::STATUS_COMPLETED]);

        // SET: MealType Times
        $mealTypes = collect();
        $breakfastEndTime = clone $breakfastTime = Carbon::now()->setTime(9,0); // 07:00 AM - 10:00 AM
        $lunchEndTime = clone $lunchTime = Carbon::now()->setTime(12,0);        // 12:00 PM - 03:00 PM
        $dinnerEndTime = clone $dinnerTime = Carbon::now()->setTime(19,0);      // 07:00 PM - 10:00 PM

        // GET: MealTypes (Previous & Current) according to the current time
        if(Carbon::parse($nowDateTime)->between($breakfastTime, $breakfastEndTime->addHours(3)))
            $mealTypes = collect(MealType::NAME_DINNER, MealType::NAME_BREAKFAST);

        else if(Carbon::parse($nowDateTime)->between($lunchTime, $lunchEndTime->addHours(3)))
            $mealTypes = collect(MealType::NAME_BREAKFAST, MealType::NAME_LUNCH);

        else if(Carbon::parse($nowDateTime)->between($dinnerTime, $dinnerEndTime->addHours(3)))
            $mealTypes = collect(MealType::NAME_LUNCH, MealType::NAME_DINNER);

        if(!$mealTypes->count())
            return 0;

        $previousMealType = $mealTypes->first();
        $currentMealType = $mealTypes->last();

        // GET: Current Meal End Time
        $mealTypeEndTime = match ($previousMealType) {
            MealType::NAME_BREAKFAST=> $breakfastEndTime,
            MealType::NAME_LUNCH    => $lunchEndTime,
            MealType::NAME_DINNER   => $dinnerEndTime,
            default => null
        };

        // MODULE: NutritionPlanDayRecipe
        $nPlanDayRecipeQuery = NutritionPlanDayRecipe::whereHas('nutritionPlanDay', function($q){

            return $q->where('status', NutritionPlanDay::STATUS_IN_PROGRESS)
                ->whereHas('nutritionPlan', function($subQuery){
                    return $subQuery->where('status', NutritionPlanDay::STATUS_IN_PROGRESS);
                });

        })->whereIn('status', [NutritionPlanDayRecipe::STATUS_TODO, NutritionPlanDayRecipe::STATUS_IN_PROGRESS])
        ->whereHas('mealType', function($subQuery) use ($mealTypes) {
            return $subQuery->whereIn('slug', $mealTypes->toArray());
        });

        if ($mealTypeEndTime instanceof Carbon && $mealTypeEndTime->isPast()) {
            // Mark In-Progress Status as Completed of the NutritionPlanDayRecipe
            $nPlanDayRecipeProgressStatusQuery = clone $nPlanDayRecipeQuery;
            $nPlanDayRecipeProgressStatusQuery
                ->whereHas('mealType', function($subQuery) use ($previousMealType) {
                    return $subQuery->where('slug', $previousMealType);
                })
                ->where('status', NutritionPlanDayRecipe::STATUS_IN_PROGRESS)
                ->update(['status' => NutritionPlanDayRecipe::STATUS_COMPLETED]);
        }

        // Mark Todo Status as In-Progress of the NutritionPlanDayRecipe
        $nPlanDayRecipeTodoStatusQuery = clone $nPlanDayRecipeQuery;
        $nPlanDayRecipeTodoStatusQuery
            ->whereHas('mealType', function($subQuery) use ($currentMealType) {
                return $subQuery->where('slug', $currentMealType);
            })
            ->where('status', NutritionPlanDayRecipe::STATUS_TODO)
            ->update(['status' => NutritionPlanDayRecipe::STATUS_IN_PROGRESS]);

        $nPlanDayRecipeProgressStatusQuery = clone $nPlanDayRecipeQuery;
        $nPlanDayRecipes = $nPlanDayRecipeProgressStatusQuery
            ->where('status', NutritionPlanDayRecipe::STATUS_IN_PROGRESS)->get();

        // Send Notification to App Users for their workout reminder
        foreach($nPlanDayRecipes as $nPlanDayRecipe) {
            $nutritionPlanDay = $nPlanDayRecipe?->nutritionPlanDay;
            $nutritionPlan = $nutritionPlanDay?->nutritionPlan;
            $user = $nutritionPlan?->user;

            if(!$user)
                continue;

            $notificationType = NotificationServiceTemplateNames::MEAL;

            $message = [
                __('nutritionPlanRecipe.notification.message', ['mealType' => $currentMealType], 'en'),
                __('nutritionPlanRecipe.notification.message', ['mealType' => $currentMealType], 'ar')
            ];

            $title = [
                __('nutritionPlanRecipe.notification.title', ['mealType' => $currentMealType], 'en'),
                __('nutritionPlanRecipe.notification.title', ['mealType' => $currentMealType], 'ar')
            ];

            sendNotification($user, $notificationType, $nPlanDayRecipe->id, $title, $message);
        }

        return 0;
    }
}
