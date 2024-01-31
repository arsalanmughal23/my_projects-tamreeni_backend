<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMealCategoryAPIRequest;
use App\Http\Requests\API\UpdateMealCategoryAPIRequest;
use App\Models\MealCategory;
use App\Repositories\MealCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MealCategoryController
 * @package App\Http\Controllers\API
 */

class MealCategoryAPIController extends AppBaseController
{
    /** @var  MealCategoryRepository */
    private $mealCategoryRepository;

    public function __construct(MealCategoryRepository $mealCategoryRepo)
    {
        $this->mealCategoryRepository = $mealCategoryRepo;
    }

    /**
     * Display a listing of the MealCategory.
     * GET|HEAD /meal_categories
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $meal_categories = $this->mealCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($meal_categories->toArray(), 'Meal Categories retrieved successfully');
    }

    /**
     * Store a newly created MealCategory in storage.
     * POST /meal_categories
     *
     * @param CreateMealCategoryAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMealCategoryAPIRequest $request)
    {
        $input = $request->all();

        $mealCategory = $this->mealCategoryRepository->create($input);

        return $this->sendResponse($mealCategory->toArray(), 'Meal Category saved successfully');
    }

    /**
     * Display the specified MealCategory.
     * GET|HEAD /meal_categories/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var MealCategory $mealCategory */
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            return $this->sendError('Meal Category not found');
        }

        return $this->sendResponse($mealCategory->toArray(), 'Meal Category retrieved successfully');
    }

    /**
     * Update the specified MealCategory in storage.
     * PUT/PATCH /meal_categories/{id}
     *
     * @param int $id
     * @param UpdateMealCategoryAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMealCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var MealCategory $mealCategory */
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            return $this->sendError('Meal Category not found');
        }

        $mealCategory = $this->mealCategoryRepository->update($input, $id);

        return $this->sendResponse($mealCategory->toArray(), 'MealCategory updated successfully');
    }

    /**
     * Remove the specified MealCategory from storage.
     * DELETE /meal_categories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var MealCategory $mealCategory */
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            return $this->sendError('Meal Category not found');
        }

        $mealCategory->delete();

        return $this->sendSuccess('Meal Category deleted successfully');
    }
}
