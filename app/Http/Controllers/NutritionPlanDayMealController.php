<?php

namespace App\Http\Controllers;

use App\DataTables\NutritionPlanDayMealDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNutritionPlanDayMealRequest;
use App\Http\Requests\UpdateNutritionPlanDayMealRequest;
use App\Repositories\NutritionPlanDayMealRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NutritionPlanDayMealController extends AppBaseController
{
    /** @var NutritionPlanDayMealRepository $nutritionPlanDayMealRepository*/
    private $nutritionPlanDayMealRepository;

    public function __construct(NutritionPlanDayMealRepository $nutritionPlanDayMealRepo)
    {
        $this->nutritionPlanDayMealRepository = $nutritionPlanDayMealRepo;
    }

    /**
     * Display a listing of the NutritionPlanDayMeal.
     *
     * @param NutritionPlanDayMealDataTable $nutritionPlanDayMealDataTable
     *
     * @return Response
     */
    public function index(NutritionPlanDayMealDataTable $nutritionPlanDayMealDataTable)
    {
        return $nutritionPlanDayMealDataTable->render('nutrition_plan_day_meals.index');
    }

    /**
     * Show the form for creating a new NutritionPlanDayMeal.
     *
     * @return Response
     */
    public function create()
    {
        return view('nutrition_plan_day_meals.create');
    }

    /**
     * Store a newly created NutritionPlanDayMeal in storage.
     *
     * @param CreateNutritionPlanDayMealRequest $request
     *
     * @return Response
     */
    public function store(CreateNutritionPlanDayMealRequest $request)
    {
        $input = $request->all();

        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->create($input);

        Flash::success('Nutrition Plan Day Meal saved successfully.');

        return redirect(route('nutrition_plan_day_meals.index'));
    }

    /**
     * Display the specified NutritionPlanDayMeal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            Flash::error('Nutrition Plan Day Meal not found');

            return redirect(route('nutrition_plan_day_meals.index'));
        }

        return view('nutrition_plan_day_meals.show')->with('nutritionPlanDayMeal', $nutritionPlanDayMeal);
    }

    /**
     * Show the form for editing the specified NutritionPlanDayMeal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            Flash::error('Nutrition Plan Day Meal not found');

            return redirect(route('nutrition_plan_day_meals.index'));
        }

        return view('nutrition_plan_day_meals.edit')->with('nutritionPlanDayMeal', $nutritionPlanDayMeal);
    }

    /**
     * Update the specified NutritionPlanDayMeal in storage.
     *
     * @param int $id
     * @param UpdateNutritionPlanDayMealRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNutritionPlanDayMealRequest $request)
    {
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            Flash::error('Nutrition Plan Day Meal not found');

            return redirect(route('nutrition_plan_day_meals.index'));
        }

        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->update($request->all(), $id);

        Flash::success('Nutrition Plan Day Meal updated successfully.');

        return redirect(route('nutrition_plan_day_meals.index'));
    }

    /**
     * Remove the specified NutritionPlanDayMeal from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionPlanDayMeal = $this->nutritionPlanDayMealRepository->find($id);

        if (empty($nutritionPlanDayMeal)) {
            Flash::error('Nutrition Plan Day Meal not found');

            return redirect(route('nutrition_plan_day_meals.index'));
        }

        $this->nutritionPlanDayMealRepository->delete($id);

        Flash::success('Nutrition Plan Day Meal deleted successfully.');

        return redirect(route('nutrition_plan_day_meals.index'));
    }
}
