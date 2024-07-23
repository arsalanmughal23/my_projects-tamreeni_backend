<?php

namespace App\Http\Controllers;

use App\DataTables\RecipeDataTable;
use App\Helper\FileHelper;
use App\Http\Requests;
use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Repositories\RecipeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Meal;
use App\Repositories\MealCategoryRepository;
use App\Repositories\MealTypeRepository;
use Response;

class RecipeController extends AppBaseController
{
    /** @var RecipeRepository $recipeRepo*/
    /** @var MealTypeRepository $mealTypeRepo*/

    public function __construct(
        private RecipeRepository $recipeRepo,
        private MealTypeRepository $mealTypeRepo,
        private MealCategoryRepository $mealCategoryRepo,
    ) {}

    /**
     * Display a listing of the Recipe.
     *
     * @param RecipeDataTable $recipeDataTable
     *
     * @return Response
     */
    public function index(RecipeDataTable $recipeDataTable)
    {
        return $recipeDataTable->render('recipes.index');
    }

    /**
     * Show the form for creating a new Recipe.
     *
     * @return Response
     */
    public function create()
    {
        $dietTypeSelectOptions = Meal::COSNT_DIET_TYPES;
        $mealTypeSelectOptions = $this->mealTypeRepo->all();
        $mealCategorySelectOptions = $this->mealCategoryRepo->all();
        return view('recipes.create', compact('dietTypeSelectOptions', 'mealTypeSelectOptions', 'mealCategorySelectOptions'));
    }

    /**
     * Store a newly created Recipe in storage.
     *
     * @param CreateRecipeRequest $request
     *
     * @return Response
     */
    public function store(CreateRecipeRequest $request)
    {
        $input = $request->validated();

        if ($request->hasFile('image'))
            $input['image'] = FileHelper::s3Upload($input['image']);

        $recipe = $this->recipeRepo->create($input);

        if(count($input['meal_category_ids']))
            $recipe->mealCategories()->sync($input['meal_category_ids']);

        Flash::success('Recipe saved successfully.');

        return redirect(route('recipes.index'));
    }

    /**
     * Display the specified Recipe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $recipe = $this->recipeRepo->find($id);

        if (empty($recipe)) {
            Flash::error('Recipe not found');

            return redirect(route('recipes.index'));
        }

        return view('recipes.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified Recipe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recipe = $this->recipeRepo->find($id);

        if (empty($recipe)) {
            Flash::error('Recipe not found');

            return redirect(route('recipes.index'));
        }

        $dietTypeSelectOptions = Meal::COSNT_DIET_TYPES;
        $mealTypeSelectOptions = $this->mealTypeRepo->all();
        $mealCategorySelectOptions = $this->mealCategoryRepo->all();

        return view('recipes.edit', compact('recipe', 'dietTypeSelectOptions', 'mealTypeSelectOptions', 'mealCategorySelectOptions'));
    }

    /**
     * Update the specified Recipe in storage.
     *
     * @param int $id
     * @param UpdateRecipeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecipeRequest $request)
    {
        $recipe = $this->recipeRepo->find($id);
        $input = $request->validated();

        if (empty($recipe)) {
            Flash::error('Recipe not found');

            return redirect(route('recipes.index'));
        }

        if ($request->hasFile('image'))
            $input['image'] = FileHelper::s3Upload($input['image']);

        $recipe = $this->recipeRepo->update($input, $id);

        if(count($input['meal_category_ids']))
            $recipe->mealCategories()->sync($input['meal_category_ids']);

        Flash::success('Recipe updated successfully.');

        return redirect(route('recipes.index'));
    }

    /**
     * Remove the specified Recipe from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $recipe = $this->recipeRepo->find($id);

        if (empty($recipe)) {
            Flash::error('Recipe not found');

            return redirect(route('recipes.index'));
        }

        $this->recipeRepo->delete($id);

        Flash::success('Recipe deleted successfully.');

        return redirect(route('recipes.index'));
    }
}
