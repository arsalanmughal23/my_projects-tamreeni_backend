<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNutritionPlanDayMealAPIRequest;
use App\Http\Requests\API\UpdateNutritionPlanDayMealAPIRequest;
use App\Models\NutritionPlanDayMeal;
use App\Repositories\NutritionPlanDayMealRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NutritionPlanDayMealController
 * @package App\Http\Controllers\API
 */

class NutritionPlanDayMealAPIController extends AppBaseController
{
    /** @var  NutritionPlanDayMealRepository */
    private $nutritionPlanDayMealRepository;

    public function __construct(NutritionPlanDayMealRepository $nutritionPlanDayMealRepo)
    {
        $this->nutritionPlanDayMealRepository = $nutritionPlanDayMealRepo;
    }

    /**
     * Display a listing of the NutritionPlanDayMeal.
     * GET|HEAD /nutrition_plan_day_meals
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $nutrition_plan_day_meals = $this->nutritionPlanDayMealRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($nutrition_plan_day_meals->toArray(), 'Nutrition Plan Day Meals retrieved successfully');
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

        return $this->sendResponse($nutritionPlanDayMeal->toArray(), 'Nutrition Plan Day Meal retrieved successfully');
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
}
