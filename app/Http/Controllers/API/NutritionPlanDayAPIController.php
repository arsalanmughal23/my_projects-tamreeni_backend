<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNutritionPlanDayAPIRequest;
use App\Http\Requests\API\UpdateNutritionPlanDayAPIRequest;
use App\Models\NutritionPlanDay;
use App\Repositories\NutritionPlanDayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NutritionPlanDayController
 * @package App\Http\Controllers\API
 */

class NutritionPlanDayAPIController extends AppBaseController
{
    /** @var  NutritionPlanDayRepository */
    private $nutritionPlanDayRepository;

    public function __construct(NutritionPlanDayRepository $nutritionPlanDayRepo)
    {
        $this->nutritionPlanDayRepository = $nutritionPlanDayRepo;
    }

    /**
     * Display a listing of the NutritionPlanDay.
     * GET|HEAD /nutrition_plan_days
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $nutrition_plan_days = $this->nutritionPlanDayRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($nutrition_plan_days->toArray(), 'Nutrition Plan Days retrieved successfully');
    }

    /**
     * Store a newly created NutritionPlanDay in storage.
     * POST /nutrition_plan_days
     *
     * @param CreateNutritionPlanDayAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateNutritionPlanDayAPIRequest $request)
    {
        $input = $request->all();

        $nutritionPlanDay = $this->nutritionPlanDayRepository->create($input);

        return $this->sendResponse($nutritionPlanDay->toArray(), 'Nutrition Plan Day saved successfully');
    }

    /**
     * Display the specified NutritionPlanDay.
     * GET|HEAD /nutrition_plan_days/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var NutritionPlanDay $nutritionPlanDay */
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            return $this->sendError('Nutrition Plan Day not found');
        }

        return $this->sendResponse($nutritionPlanDay->toArray(), 'Nutrition Plan Day retrieved successfully');
    }

    /**
     * Update the specified NutritionPlanDay in storage.
     * PUT/PATCH /nutrition_plan_days/{id}
     *
     * @param int $id
     * @param UpdateNutritionPlanDayAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateNutritionPlanDayAPIRequest $request)
    {
        $input = $request->all();

        /** @var NutritionPlanDay $nutritionPlanDay */
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            return $this->sendError('Nutrition Plan Day not found');
        }

        $nutritionPlanDay = $this->nutritionPlanDayRepository->update($input, $id);

        return $this->sendResponse($nutritionPlanDay->toArray(), 'NutritionPlanDay updated successfully');
    }

    /**
     * Remove the specified NutritionPlanDay from storage.
     * DELETE /nutrition_plan_days/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var NutritionPlanDay $nutritionPlanDay */
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            return $this->sendError('Nutrition Plan Day not found');
        }

        $nutritionPlanDay->delete();

        return $this->sendSuccess('Nutrition Plan Day deleted successfully');
    }
}
