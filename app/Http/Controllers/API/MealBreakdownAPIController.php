<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMealBreakdownAPIRequest;
use App\Http\Requests\API\UpdateMealBreakdownAPIRequest;
use App\Models\MealBreakdown;
use App\Repositories\MealBreakdownRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MealBreakdownController
 * @package App\Http\Controllers\API
 */

class MealBreakdownAPIController extends AppBaseController
{
    /** @var  MealBreakdownRepository */
    private $mealBreakdownRepository;

    public function __construct(MealBreakdownRepository $mealBreakdownRepo)
    {
        $this->mealBreakdownRepository = $mealBreakdownRepo;
    }

    /**
     * Display a listing of the MealBreakdown.
     * GET|HEAD /meal_breakdowns
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $meal_breakdowns = $this->mealBreakdownRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($meal_breakdowns->toArray(), 'Meal Breakdowns retrieved successfully');
    }

    /**
     * Store a newly created MealBreakdown in storage.
     * POST /meal_breakdowns
     *
     * @param CreateMealBreakdownAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMealBreakdownAPIRequest $request)
    {
        $input = $request->all();

        $mealBreakdown = $this->mealBreakdownRepository->create($input);

        return $this->sendResponse($mealBreakdown->toArray(), 'Meal Breakdown saved successfully');
    }

    /**
     * Display the specified MealBreakdown.
     * GET|HEAD /meal_breakdowns/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var MealBreakdown $mealBreakdown */
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            return $this->sendError('Meal Breakdown not found');
        }

        return $this->sendResponse($mealBreakdown->toArray(), 'Meal Breakdown retrieved successfully');
    }

    /**
     * Update the specified MealBreakdown in storage.
     * PUT/PATCH /meal_breakdowns/{id}
     *
     * @param int $id
     * @param UpdateMealBreakdownAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMealBreakdownAPIRequest $request)
    {
        $input = $request->all();

        /** @var MealBreakdown $mealBreakdown */
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            return $this->sendError('Meal Breakdown not found');
        }

        $mealBreakdown = $this->mealBreakdownRepository->update($input, $id);

        return $this->sendResponse($mealBreakdown->toArray(), 'MealBreakdown updated successfully');
    }

    /**
     * Remove the specified MealBreakdown from storage.
     * DELETE /meal_breakdowns/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var MealBreakdown $mealBreakdown */
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            return $this->sendError('Meal Breakdown not found');
        }

        $mealBreakdown->delete();

        return $this->sendSuccess('Meal Breakdown deleted successfully');
    }
}
