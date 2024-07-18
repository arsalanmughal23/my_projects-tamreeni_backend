<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNutritionPlanDayRecipeAPIRequest;
use App\Http\Requests\API\UpdateNutritionPlanDayRecipeAPIRequest;
use App\Models\NutritionPlanDayRecipe;
use App\Repositories\NutritionPlanDayRecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NutritionPlanDayRecipeController
 * @package App\Http\Controllers\API
 */

class NutritionPlanDayRecipeAPIController extends AppBaseController
{
    /** @var  NutritionPlanDayRecipeRepository */
    private $nutritionPlanDayRecipeRepository;

    public function __construct(NutritionPlanDayRecipeRepository $nutritionPlanDayRecipeRepo)
    {
        $this->nutritionPlanDayRecipeRepository = $nutritionPlanDayRecipeRepo;
    }

    /**
     * Display a listing of the NutritionPlanDayRecipe.
     * GET|HEAD /nutrition_plan_day_recipes
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $nutrition_plan_day_recipes = $this->nutritionPlanDayRecipeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($nutrition_plan_day_recipes->toArray(), 'Nutrition Plan Day Recipes retrieved successfully');
    }

    /**
     * Store a newly created NutritionPlanDayRecipe in storage.
     * POST /nutrition_plan_day_recipes
     *
     * @param CreateNutritionPlanDayRecipeAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateNutritionPlanDayRecipeAPIRequest $request)
    {
        $input = $request->all();

        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->create($input);

        return $this->sendResponse($nutritionPlanDayRecipe->toArray(), 'Nutrition Plan Day Recipe saved successfully');
    }

    /**
     * Display the specified NutritionPlanDayRecipe.
     * GET|HEAD /nutrition_plan_day_recipes/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var NutritionPlanDayRecipe $nutritionPlanDayRecipe */
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            return $this->sendError('Nutrition Plan Day Recipe not found');
        }

        return $this->sendResponse($nutritionPlanDayRecipe->toArray(), 'Nutrition Plan Day Recipe retrieved successfully');
    }

    /**
     * Update the specified NutritionPlanDayRecipe in storage.
     * PUT/PATCH /nutrition_plan_day_recipes/{id}
     *
     * @param int $id
     * @param UpdateNutritionPlanDayRecipeAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateNutritionPlanDayRecipeAPIRequest $request)
    {
        $input = $request->all();

        /** @var NutritionPlanDayRecipe $nutritionPlanDayRecipe */
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            return $this->sendError('Nutrition Plan Day Recipe not found');
        }

        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->update($input, $id);

        return $this->sendResponse($nutritionPlanDayRecipe->toArray(), 'NutritionPlanDayRecipe updated successfully');
    }

    /**
     * Remove the specified NutritionPlanDayRecipe from storage.
     * DELETE /nutrition_plan_day_recipes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var NutritionPlanDayRecipe $nutritionPlanDayRecipe */
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            return $this->sendError('Nutrition Plan Day Recipe not found');
        }

        $nutritionPlanDayRecipe->delete();

        return $this->sendSuccess('Nutrition Plan Day Recipe deleted successfully');
    }
}
