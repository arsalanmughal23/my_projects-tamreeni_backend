<?php

namespace App\Http\Controllers;

use App\DataTables\NutritionPlanDayRecipeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNutritionPlanDayRecipeRequest;
use App\Http\Requests\UpdateNutritionPlanDayRecipeRequest;
use App\Repositories\NutritionPlanDayRecipeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NutritionPlanDayRecipeController extends AppBaseController
{
    /** @var NutritionPlanDayRecipeRepository $nutritionPlanDayRecipeRepository*/
    private $nutritionPlanDayRecipeRepository;

    public function __construct(NutritionPlanDayRecipeRepository $nutritionPlanDayRecipeRepo)
    {
        $this->nutritionPlanDayRecipeRepository = $nutritionPlanDayRecipeRepo;
    }

    /**
     * Display a listing of the NutritionPlanDayRecipe.
     *
     * @param NutritionPlanDayRecipeDataTable $nutritionPlanDayRecipeDataTable
     *
     * @return Response
     */
    public function index(NutritionPlanDayRecipeDataTable $nutritionPlanDayRecipeDataTable)
    {
        return $nutritionPlanDayRecipeDataTable->render('nutrition_plan_day_recipes.index');
    }

    /**
     * Show the form for creating a new NutritionPlanDayRecipe.
     *
     * @return Response
     */
    public function create()
    {
        return view('nutrition_plan_day_recipes.create');
    }

    /**
     * Store a newly created NutritionPlanDayRecipe in storage.
     *
     * @param CreateNutritionPlanDayRecipeRequest $request
     *
     * @return Response
     */
    public function store(CreateNutritionPlanDayRecipeRequest $request)
    {
        $input = $request->all();

        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->create($input);

        Flash::success('Nutrition Plan Day Recipe saved successfully.');

        return redirect(route('nutrition_plan_day_recipes.index'));
    }

    /**
     * Display the specified NutritionPlanDayRecipe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            Flash::error('Nutrition Plan Day Recipe not found');

            return redirect(route('nutrition_plan_day_recipes.index'));
        }

        return view('nutrition_plan_day_recipes.show')->with('nutritionPlanDayRecipe', $nutritionPlanDayRecipe);
    }

    /**
     * Show the form for editing the specified NutritionPlanDayRecipe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            Flash::error('Nutrition Plan Day Recipe not found');

            return redirect(route('nutrition_plan_day_recipes.index'));
        }

        return view('nutrition_plan_day_recipes.edit')->with('nutritionPlanDayRecipe', $nutritionPlanDayRecipe);
    }

    /**
     * Update the specified NutritionPlanDayRecipe in storage.
     *
     * @param int $id
     * @param UpdateNutritionPlanDayRecipeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNutritionPlanDayRecipeRequest $request)
    {
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            Flash::error('Nutrition Plan Day Recipe not found');

            return redirect(route('nutrition_plan_day_recipes.index'));
        }

        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->update($request->all(), $id);

        Flash::success('Nutrition Plan Day Recipe updated successfully.');

        return redirect(route('nutrition_plan_day_recipes.index'));
    }

    /**
     * Remove the specified NutritionPlanDayRecipe from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepository->find($id);

        if (empty($nutritionPlanDayRecipe)) {
            Flash::error('Nutrition Plan Day Recipe not found');

            return redirect(route('nutrition_plan_day_recipes.index'));
        }

        $this->nutritionPlanDayRecipeRepository->delete($id);

        Flash::success('Nutrition Plan Day Recipe deleted successfully.');

        return redirect(route('nutrition_plan_day_recipes.index'));
    }
}
