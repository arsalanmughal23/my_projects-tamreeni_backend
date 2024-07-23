<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRecipeIngredientAPIRequest;
use App\Http\Requests\API\UpdateRecipeIngredientAPIRequest;
use App\Models\RecipeIngredient;
use App\Repositories\RecipeIngredientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RecipeIngredientController
 * @package App\Http\Controllers\API
 */

class RecipeIngredientAPIController extends AppBaseController
{
    /** @var  RecipeIngredientRepository */
    private $recipeIngredientRepository;

    public function __construct(RecipeIngredientRepository $recipeIngredientRepo)
    {
        $this->recipeIngredientRepository = $recipeIngredientRepo;
    }

    /**
     * Display a listing of the RecipeIngredient.
     * GET|HEAD /recipe_ingredients
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $recipe_ingredients = $this->recipeIngredientRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($recipe_ingredients->toArray(), 'Recipe Ingredients retrieved successfully');
    }

    /**
     * Store a newly created RecipeIngredient in storage.
     * POST /recipe_ingredients
     *
     * @param CreateRecipeIngredientAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateRecipeIngredientAPIRequest $request)
    {
        $input = $request->all();

        $recipeIngredient = $this->recipeIngredientRepository->create($input);

        return $this->sendResponse($recipeIngredient->toArray(), 'Recipe Ingredient saved successfully');
    }

    /**
     * Display the specified RecipeIngredient.
     * GET|HEAD /recipe_ingredients/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var RecipeIngredient $recipeIngredient */
        $recipeIngredient = $this->recipeIngredientRepository->find($id);

        if (empty($recipeIngredient)) {
            return $this->sendError('Recipe Ingredient not found');
        }

        return $this->sendResponse($recipeIngredient->toArray(), 'Recipe Ingredient retrieved successfully');
    }

    /**
     * Update the specified RecipeIngredient in storage.
     * PUT/PATCH /recipe_ingredients/{id}
     *
     * @param int $id
     * @param UpdateRecipeIngredientAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateRecipeIngredientAPIRequest $request)
    {
        $input = $request->all();

        /** @var RecipeIngredient $recipeIngredient */
        $recipeIngredient = $this->recipeIngredientRepository->find($id);

        if (empty($recipeIngredient)) {
            return $this->sendError('Recipe Ingredient not found');
        }

        $recipeIngredient = $this->recipeIngredientRepository->update($input, $id);

        return $this->sendResponse($recipeIngredient->toArray(), 'RecipeIngredient updated successfully');
    }

    /**
     * Remove the specified RecipeIngredient from storage.
     * DELETE /recipe_ingredients/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var RecipeIngredient $recipeIngredient */
        $recipeIngredient = $this->recipeIngredientRepository->find($id);

        if (empty($recipeIngredient)) {
            return $this->sendError('Recipe Ingredient not found');
        }

        $recipeIngredient->delete();

        return $this->sendSuccess('Recipe Ingredient deleted successfully');
    }
}
