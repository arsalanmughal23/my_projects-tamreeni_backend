<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNutritionPlanDayMealAPIRequest;
use App\Http\Requests\API\UpdateNutritionPlanDayMealAPIRequest;
use App\Models\NutritionPlanDayMeal;
use App\Repositories\NutritionPlanDayMealRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UserAdditionalMealConsumedAPIRequest;
use App\Http\Resources\NutritionPlanDayMealResource;
use App\Http\Resources\NutritionPlanDayRecipeResource;
use App\Models\NutritionPlan;
use App\Models\NutritionPlanDay;
use App\Models\NutritionPlanDayRecipe;
use App\Repositories\NutritionPlanDayRecipeRepository;
use App\Repositories\NutritionPlanDayRepository;
use App\Repositories\NutritionPlanRepository;
use Response;

/**
 * Class NutritionPlanDayMealController
 * @package App\Http\Controllers\API
 */

class NutritionPlanDayMealAPIController extends AppBaseController
{
    /** @var  NutritionPlanDayMealRepository */

    public function __construct(
        private NutritionPlanDayMealRepository $nutritionPlanDayMealRepository,
        private NutritionPlanDayRecipeRepository $nutritionPlanDayRecipeRepository,
        private NutritionPlanDayRepository $nutritionPlanDayRepository,
        private NutritionPlanRepository $nutritionPlanRepository,
    ){}

    /**
     * Display a listing of the NutritionPlanDayMeal.
     * GET|HEAD /nutrition_plan_day_meals
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $nutrition_plan_day_meals = $this->nutritionPlanDayMealRepository->all($request->only('nutrition_plan_day_id', 'status'));

        return $this->sendResponse(NutritionPlanDayMealResource::collection($nutrition_plan_day_meals), 'Nutrition Plan Day Meals retrieved successfully');
    }

    /**
     * Store a newly created NutritionPlanDayMeal in storage.
     * POST /nutrition_plan_day_meals
     *
     * @param CreateNutritionPlanDayMealAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateNutritionPlanDayMealAPIRequest $request)
    {
        $input = $request->all();

        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->create($input);

        return $this->sendResponse($nutritionPlanDayMeal->toArray(), 'Nutrition Plan Day Meal saved successfully');
    }

    /**
     * Display the specified NutritionPlanDayMeal.
     * GET|HEAD /nutrition_plan_day_meals/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var NutritionPlanDayMeal $nutritionPlanDayMeal */
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            return $this->sendError('Nutrition Plan Day Meal not found');
        }

        return $this->sendResponse(new NutritionPlanDayMealResource($nutritionPlanDayMeal), 'Nutrition Plan Day Meal retrieved successfully');
    }

    /**
     * Update the specified NutritionPlanDayMeal in storage.
     * PUT/PATCH /nutrition_plan_day_meals/{id}
     *
     * @param int $id
     * @param UpdateNutritionPlanDayMealAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateNutritionPlanDayMealAPIRequest $request)
    {
        $input = $request->all();

        /** @var NutritionPlanDayMeal $nutritionPlanDayMeal */
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            return $this->sendError('Nutrition Plan Day Meal not found');
        }

        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->update($input, $id);

        return $this->sendResponse($nutritionPlanDayMeal->toArray(), 'NutritionPlanDayMeal updated successfully');
    }

    /**
     * Remove the specified NutritionPlanDayMeal from storage.
     * DELETE /nutrition_plan_day_meals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var NutritionPlanDayMeal $nutritionPlanDayMeal */
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            return $this->sendError('Nutrition Plan Day Meal not found');
        }

        $nutritionPlanDayMeal->delete();

        return $this->sendSuccess('Nutrition Plan Day Meal deleted successfully');
    }

    public function userMealConsumed($nutritionPlanDayMealId, Request $request) 
    {
        $user = $request->user();
        $userDetails = $user?->details;

        /** @var NutritionPlanDayMeal $nutritionPlanDayMeal */
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->findWithoutFail($nutritionPlanDayMealId);
        $mealNutritionPlan = $nutritionPlanDayMeal?->nutritionPlanDay?->nutritionPlan;

        if (!$nutritionPlanDayMeal || $mealNutritionPlan?->user_id != $user->id)
            return $this->sendError('Your nutrition plan doesn`t have this meal');

        // Need to Change when Cron Is Applying
        // User should not consume their meal that's not have STATUS_IN_PROGRESS
        if ($nutritionPlanDayMeal->status == NutritionPlan::STATUS_COMPLETED)
            return $this->sendError('This meal is already consumed', 403);

        // Increase user intake calories
        $userDetails->calories += $nutritionPlanDayMeal->calories ?? 0;
        if($userDetails->calories > 999999)
            return $this->sendError('You have maximum of calories', 403);

        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->update([ 'status' => NutritionPlanDayMeal::STATUS_COMPLETED ], $nutritionPlanDayMealId);
        $userDetails->save();

        return $this->sendResponse($nutritionPlanDayMeal->toArray(), 'Meal consumed successfully');
    }

    public function userRecipeConsumed($nutritionPlanDayRecipeId, Request $request) 
    {
        $user = $request->user();
        $userDetails = $user?->details;

        /** @var NutritionPlanDayRecipe $nutritionPlanDayRecipe */
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->findWithoutFail($nutritionPlanDayRecipeId);
        $recipeNutritionPlan = $nutritionPlanDayRecipe?->nutritionPlanDay?->nutritionPlan;

        if (!$nutritionPlanDayRecipe || $recipeNutritionPlan?->user_id != $user->id)
            return $this->sendError('Your nutrition plan doesn`t have this recipe');

        // Need to Change when Cron Is Applying
        // User should not consume their recipe that's not have STATUS_IN_PROGRESS
        if ($nutritionPlanDayRecipe->status != NutritionPlanDayRecipe::STATUS_IN_PROGRESS)
            return $this->sendError('This recipe is already consumed', 403);

        // Increase user intake calories
        $userDetails->calories += $nutritionPlanDayRecipe->calories ?? 0;
        if($userDetails->calories > 999999)
            return $this->sendError('You have maximum of calories', 403);

        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->update([ 'status' => NutritionPlanDayRecipe::STATUS_COMPLETED ], $nutritionPlanDayRecipeId);
        $userDetails->save();

        return $this->sendResponse(new NutritionPlanDayRecipeResource($nutritionPlanDayRecipe), 'Recipe consumed successfully');
    }

    public function userAdditionalMealConsumed(UserAdditionalMealConsumedAPIRequest $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $userDetails = $user?->details;

        $todayDate = now()->format('Y-m-d');

        // Get User's Active Nutrition Plan
        $activeUserNutritionPlan = $this->nutritionPlanRepository->getUserActiveNutritionPlanByDate($user_id, $todayDate);
        if(!$activeUserNutritionPlan)
            return $this->sendError('You don`t have active nutrition plan', 403);

        // Get User's Nutrition Plan Active Day
        $activeUserNutritionPlanDay = $this->nutritionPlanDayRepository->getNutritionPlanActiveDayByDate($activeUserNutritionPlan->id, $todayDate);
        if(!$activeUserNutritionPlanDay)
            return $this->sendError('You don`t have active nutrition plan for today', 403);

        // Add User Additional Meal with marked as Consumed
        $data = $request->validated();
        $data = array_merge($data, ['nutrition_plan_day_id' => $activeUserNutritionPlanDay->id, 'status' => NutritionPlanDay::STATUS_COMPLETED]);
        // $additionalMealConsumed = $this->nutritionPlanDayMealRepository->userAdditionalMealConsumed($data);

        // Increase user intake calories
        // $userDetails->calories += $additionalMealConsumed->calories;
        $userDetails->calories += $data['calories'] ?? 0;
        if($userDetails->calories > 999999)
            return $this->sendError('You have maximum of calories', 403);

        $userDetails->save();

        return $this->sendResponse(null, 'Additional Meal consumed successfully');
    }
}
