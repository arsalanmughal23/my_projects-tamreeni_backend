<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMealAPIRequest;
use App\Http\Requests\API\UpdateMealAPIRequest;
use App\Models\Meal;
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
        $meals = $this->mealRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($meals->toArray(), 'Meals retrieved successfully');
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

    public function searchMeals(Request $request)
    {
        $perPage = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $query = Meal::query();

        // Search by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Search by category
        if ($request->has('category_id')) {
            $query->where('meal_category_id', $request->input('category_id'));
        }

        // Search by calories range
        if ($request->has('min_calories')) {
            $query->where('calories', '>=', $request->input('min_calories'));
        }

        if ($request->has('max_calories')) {
            $query->where('calories', '<=', $request->input('max_calories'));
        }

        $meals = $query->paginate($perPage);

        return $this->sendResponse($meals->toArray(), 'Meals retrieved successfully');
    }
}
