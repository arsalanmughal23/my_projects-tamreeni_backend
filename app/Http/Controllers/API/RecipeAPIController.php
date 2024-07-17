<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRecipeAPIRequest;
use App\Http\Requests\API\UpdateRecipeAPIRequest;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RecipeController
 * @package App\Http\Controllers\API
 */

class RecipeAPIController extends AppBaseController
{
    /** @var  RecipeRepository */
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepo)
    {
        $this->recipeRepository = $recipeRepo;
    }

    /**
     * Display a listing of the Recipe.
     * GET|HEAD /recipes
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $recipes = $this->recipeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($recipes->toArray(), 'Recipes retrieved successfully');
    }

    /**
     * Store a newly created Recipe in storage.
     * POST /recipes
     *
     * @param CreateRecipeAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateRecipeAPIRequest $request)
    {
        $input = $request->all();

        $recipe = $this->recipeRepository->create($input);

        return $this->sendResponse($recipe->toArray(), 'Recipe saved successfully');
    }

    /**
     * Display the specified Recipe.
     * GET|HEAD /recipes/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        return $this->sendResponse($recipe->toArray(), 'Recipe retrieved successfully');
    }

    /**
     * Update the specified Recipe in storage.
     * PUT/PATCH /recipes/{id}
     *
     * @param int $id
     * @param UpdateRecipeAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateRecipeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        $recipe = $this->recipeRepository->update($input, $id);

        return $this->sendResponse($recipe->toArray(), 'Recipe updated successfully');
    }

    /**
     * Remove the specified Recipe from storage.
     * DELETE /recipes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        $recipe->delete();

        return $this->sendSuccess('Recipe deleted successfully');
    }
}
