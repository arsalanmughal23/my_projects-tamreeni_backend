<?php

namespace App\Http\Controllers;

use App\DataTables\MealCategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMealCategoryRequest;
use App\Http\Requests\UpdateMealCategoryRequest;
use App\Repositories\MealCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MealCategoryController extends AppBaseController
{
    /** @var MealCategoryRepository $mealCategoryRepository*/
    private $mealCategoryRepository;

    public function __construct(MealCategoryRepository $mealCategoryRepo)
    {
        $this->mealCategoryRepository = $mealCategoryRepo;
    }

    /**
     * Display a listing of the MealCategory.
     *
     * @param MealCategoryDataTable $mealCategoryDataTable
     *
     * @return Response
     */
    public function index(MealCategoryDataTable $mealCategoryDataTable)
    {
        return $mealCategoryDataTable->render('meal_categories.index');
    }

    /**
     * Show the form for creating a new MealCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('meal_categories.create');
    }

    /**
     * Store a newly created MealCategory in storage.
     *
     * @param CreateMealCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateMealCategoryRequest $request)
    {
        $input = $request->all();

        $mealCategory = $this->mealCategoryRepository->create($input);

        Flash::success('Meal Category saved successfully.');

        return redirect(route('meal_categories.index'));
    }

    /**
     * Display the specified MealCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            Flash::error('Meal Category not found');

            return redirect(route('meal_categories.index'));
        }

        return view('meal_categories.show')->with('mealCategory', $mealCategory);
    }

    /**
     * Show the form for editing the specified MealCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            Flash::error('Meal Category not found');

            return redirect(route('meal_categories.index'));
        }

        return view('meal_categories.edit')->with('mealCategory', $mealCategory);
    }

    /**
     * Update the specified MealCategory in storage.
     *
     * @param int $id
     * @param UpdateMealCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMealCategoryRequest $request)
    {
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            Flash::error('Meal Category not found');

            return redirect(route('meal_categories.index'));
        }

        $mealCategory = $this->mealCategoryRepository->update($request->all(), $id);

        Flash::success('Meal Category updated successfully.');

        return redirect(route('meal_categories.index'));
    }

    /**
     * Remove the specified MealCategory from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mealCategory = $this->mealCategoryRepository->find($id);

        if (empty($mealCategory)) {
            Flash::error('Meal Category not found');

            return redirect(route('meal_categories.index'));
        }

        $this->mealCategoryRepository->delete($id);

        Flash::success('Meal Category deleted successfully.');

        return redirect(route('meal_categories.index'));
    }
}
