<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNutritionPlanAPIRequest;
use App\Http\Requests\API\UpdateNutritionPlanAPIRequest;
use App\Models\NutritionPlan;
use App\Repositories\NutritionPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NutritionPlanController
 * @package App\Http\Controllers\API
 */

class NutritionPlanAPIController extends AppBaseController
{
    /** @var  NutritionPlanRepository */
    private $nutritionPlanRepository;

    public function __construct(NutritionPlanRepository $nutritionPlanRepo)
    {
        $this->nutritionPlanRepository = $nutritionPlanRepo;
    }

    /**
     * Display a listing of the NutritionPlan.
     * GET|HEAD /nutrition_plans
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $nutrition_plans = $this->nutritionPlanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($nutrition_plans->toArray(), 'Nutrition Plans retrieved successfully');
    }

    /**
     * Store a newly created NutritionPlan in storage.
     * POST /nutrition_plans
     *
     * @param CreateNutritionPlanAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateNutritionPlanAPIRequest $request)
    {
        $input = $request->all();

        $nutritionPlan = $this->nutritionPlanRepository->create($input);

        return $this->sendResponse($nutritionPlan->toArray(), 'Nutrition Plan saved successfully');
    }

    /**
     * Display the specified NutritionPlan.
     * GET|HEAD /nutrition_plans/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var NutritionPlan $nutritionPlan */
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            return $this->sendError('Nutrition Plan not found');
        }

        return $this->sendResponse($nutritionPlan->toArray(), 'Nutrition Plan retrieved successfully');
    }

    /**
     * Update the specified NutritionPlan in storage.
     * PUT/PATCH /nutrition_plans/{id}
     *
     * @param int $id
     * @param UpdateNutritionPlanAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateNutritionPlanAPIRequest $request)
    {
        $input = $request->all();

        /** @var NutritionPlan $nutritionPlan */
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            return $this->sendError('Nutrition Plan not found');
        }

        $nutritionPlan = $this->nutritionPlanRepository->update($input, $id);

        return $this->sendResponse($nutritionPlan->toArray(), 'NutritionPlan updated successfully');
    }

    /**
     * Remove the specified NutritionPlan from storage.
     * DELETE /nutrition_plans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var NutritionPlan $nutritionPlan */
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            return $this->sendError('Nutrition Plan not found');
        }

        $nutritionPlan->delete();

        return $this->sendSuccess('Nutrition Plan deleted successfully');
    }
}
