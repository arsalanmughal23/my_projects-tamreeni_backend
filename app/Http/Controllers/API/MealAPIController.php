<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMealAPIRequest;
use App\Http\Requests\API\UpdateMealAPIRequest;
use App\Models\Meal;
use App\Models\Exercise;
use App\Repositories\MealRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Config;
use DB;

/**
 * Class MealController
 * @package App\Http\Controllers\API
 */

class MealAPIController extends AppBaseController
{
    /** @var  MealRepository */
    private $mealRepository;

    public function __construct(MealRepository $mealRepo)
    {
        $this->mealRepository = $mealRepo;
    }

    /**
     * Display a listing of the Meal.
     * GET|HEAD /meals
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $meals = $this->mealRepository->search(
            $request->get('keyword'),
            ['name', 'description'],
            $request->only(['diet_type']),
        );

        $mealCategoryIds = $request->get('meal_category_ids');
        if(is_array($mealCategoryIds) && count($mealCategoryIds)){
            $mealCategoryIds = array_map('intval', $mealCategoryIds);
            $meals = $meals->whereIn('meal_category_id', $mealCategoryIds);
        }

        $minCalorie = floatval($request->get('min_calories'));
        $maxCalorie = floatval($request->get('max_calories'));
        if($minCalorie)
            $meals = $meals->where('calories', '>=', $minCalorie);
        if($maxCalorie)
            $meals = $meals->where('calories', '<=', $maxCalorie);

        $perPage = $request->get('per_page', config('constants.PER_PAGE'));
        if ($request->get('is_paginate')) {
            $meals = $meals->paginate($perPage);
        } else {
            $meals = $meals->get();
        }

        return $this->sendResponse($meals, 'Meals retrieved successfully');
    }

    /**
     * Store a newly created Meal in storage.
     * POST /meals
     *
     * @param CreateMealAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMealAPIRequest $request)
    {
        $input = $request->all();

        $meal = $this->mealRepository->create($input);

        return $this->sendResponse($meal->toArray(), 'Meal saved successfully');
    }

    /**
     * Display the specified Meal.
     * GET|HEAD /meals/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Meal $meal */
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            return $this->sendError('Meal not found');
        }

        return $this->sendResponse($meal->toArray(), 'Meal retrieved successfully');
    }

    /**
     * Update the specified Meal in storage.
     * PUT/PATCH /meals/{id}
     *
     * @param int $id
     * @param UpdateMealAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMealAPIRequest $request)
    {
        $input = $request->all();

        /** @var Meal $meal */
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            return $this->sendError('Meal not found');
        }

        $meal = $this->mealRepository->update($input, $id);

        return $this->sendResponse($meal->toArray(), 'Meal updated successfully');
    }

    /**
     * Remove the specified Meal from storage.
     * DELETE /meals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Meal $meal */
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            return $this->sendError('Meal not found');
        }

        $meal->delete();

        return $this->sendSuccess('Meal deleted successfully');
    }

    public function search(Request $request)
    {
        $perPage = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $exerciseQuery = Exercise::query();
        $mealsQuery = Meal::query();
    
        // Search by name
        if ($request->has('name')) {
            $mealsQuery->where('name', 'like', '%' . $request->input('name') . '%');
            $exerciseQuery->where('name', 'like', '%' . $request->input('name') . '%');
        }
    
        // Search by category
        if ($request->has('category_id')) {
            $mealsQuery->where('meal_category_id', $request->input('category_id'));
        }
    
        // Search by calories range
        if ($request->has('min_calories')) {
            $mealsQuery->where('calories', '>=', $request->input('min_calories'));
        }
    
        if ($request->has('max_calories')) {
            $mealsQuery->where('calories', '<=', $request->input('max_calories'));
        }

    // Check if body_part_ids array is given
    if ($request->has('body_part_ids')) {
        $bodyPartIds = $request->input('body_part_ids');
        $exerciseQuery->whereHas('bodyPart', function ($query) use ($bodyPartIds) {
            $query->whereIn('id', $bodyPartIds);
        });
    }

        // Check if exercise_equipment_ids array is given
        if ($request->has('exercise_equipment_ids')) {
            $exerciseEquipmentIds = $request->input('exercise_equipment_ids');
            $exerciseQuery->whereHas('exerciseEquipmentPivots', function ($query) use ($exerciseEquipmentIds) {
                $query->whereIn('exercise_equipment_id', $exerciseEquipmentIds);
            });
        }
    
        $meals = $mealsQuery->paginate($perPage);
        $exercises = $exerciseQuery->paginate($perPage);
    
        return $this->sendResponse([
            'meals' => $meals->toArray(),
            'exercises' => $exercises->toArray()
        ], 'Meals and exercises retrieved successfully');
    }
    
}
