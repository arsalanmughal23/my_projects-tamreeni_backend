<?php

namespace App\Http\Controllers;

use App\DataTables\RecipeIngredientDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRecipeIngredientRequest;
use App\Http\Requests\UpdateRecipeIngredientRequest;
use App\Repositories\RecipeIngredientRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\RecipeRepository;
use Response;

class RecipeIngredientController extends AppBaseController
{
    /** @var RecipeIngredientRepository $recipeIngredientRepo*/

    public function __construct(
        protected RecipeIngredientRepository $recipeIngredientRepo,
        protected RecipeRepository $recipeRepo
    ) {}

    /**
     * Display a listing of the RecipeIngredient.
     *
     * @param RecipeIngredientDataTable $recipeIngredientDataTable
     *
     * @return Response
     */
    public function index(RecipeIngredientDataTable $recipeIngredientDataTable)
    {
        return $recipeIngredientDataTable->render('recipe_ingredients.index');
    }

    /**
     * Show the form for creating a new RecipeIngredient.
     *
     * @return Response
     */
    public function create()
    {
        $typeSelectOptions = $this->recipeIngredientRepo->getTypeSelectOptions();
        $unitSelectOptions = $this->recipeIngredientRepo->getUnitSelectOptions();
        $recipeSelectOptions = $this->recipeRepo->getRecipeSelectOptions();

        return view('recipe_ingredients.create', compact('typeSelectOptions', 'unitSelectOptions', 'recipeSelectOptions'));
    }

    /**
     * Store a newly created RecipeIngredient in storage.
     *
     * @param CreateRecipeIngredientRequest $request
     *
     * @return Response
     */
    public function store(CreateRecipeIngredientRequest $request)
    {
        $input = $request->all();

        $recipeIngredient = $this->recipeIngredientRepo->create($input);

        Flash::success('Recipe Ingredient saved successfully.');

        return redirect(route('recipe_ingredients.index'));
    }

    /**
     * Display the specified RecipeIngredient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $recipeIngredient = $this->recipeIngredientRepo->find($id);

        if (empty($recipeIngredient)) {
            Flash::error('Recipe Ingredient not found');

            return redirect(route('recipe_ingredients.index'));
        }

        return view('recipe_ingredients.show')->with('recipeIngredient', $recipeIngredient);
    }

    /**
     * Show the form for editing the specified RecipeIngredient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recipeIngredient = $this->recipeIngredientRepo->find($id);

        if (empty($recipeIngredient)) {
            Flash::error('Recipe Ingredient not found');

            return redirect(route('recipe_ingredients.index'));
        }

        $typeSelectOptions = $this->recipeIngredientRepo->getTypeSelectOptions();
        $unitSelectOptions = $this->recipeIngredientRepo->getUnitSelectOptions();
        $recipeSelectOptions = $this->recipeRepo->getRecipeSelectOptions();

        return view('recipe_ingredients.edit', compact('recipeIngredient', 'typeSelectOptions', 'unitSelectOptions', 'recipeSelectOptions'));
    }

    /**
     * Update the specified RecipeIngredient in storage.
     *
     * @param int $id
     * @param UpdateRecipeIngredientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecipeIngredientRequest $request)
    {
        $recipeIngredient = $this->recipeIngredientRepo->find($id);

        if (empty($recipeIngredient)) {
            Flash::error('Recipe Ingredient not found');

            return redirect(route('recipe_ingredients.index'));
        }

        $recipeIngredient = $this->recipeIngredientRepo->update($request->all(), $id);

        Flash::success('Recipe Ingredient updated successfully.');

        return redirect(route('recipe_ingredients.index'));
    }

    /**
     * Remove the specified RecipeIngredient from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $recipeIngredient = $this->recipeIngredientRepo->find($id);

        if (empty($recipeIngredient)) {
            Flash::error('Recipe Ingredient not found');

            return redirect(route('recipe_ingredients.index'));
        }

        $this->recipeIngredientRepo->delete($id);

        Flash::success('Recipe Ingredient deleted successfully.');

        return redirect(route('recipe_ingredients.index'));
    }
}
