<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNplanDayRecipeIngredientAPIRequest;
use App\Http\Requests\API\UpdateNplanDayRecipeIngredientAPIRequest;
use App\Models\NplanDayRecipeIngredient;
use App\Repositories\NplanDayRecipeIngredientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NplanDayRecipeIngredientController
 * @package App\Http\Controllers\API
 */

class NplanDayRecipeIngredientAPIController extends AppBaseController
{
    /** @var  NplanDayRecipeIngredientRepository */
    private $nplanDayRecipeIngredientRepository;

    public function __construct(NplanDayRecipeIngredientRepository $nplanDayRecipeIngredientRepo)
    {
        $this->nplanDayRecipeIngredientRepository = $nplanDayRecipeIngredientRepo;
    }

    /**
     * Display a listing of the NplanDayRecipeIngredient.
     * GET|HEAD /nplan_day_recipe_ingredients
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $nplan_day_recipe_ingredients = $this->nplanDayRecipeIngredientRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($nplan_day_recipe_ingredients->toArray(), 'Nplan Day Recipe Ingredients retrieved successfully');
    }

    /**
     * Store a newly created NplanDayRecipeIngredient in storage.
     * POST /nplan_day_recipe_ingredients
     *
     * @param CreateNplanDayRecipeIngredientAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateNplanDayRecipeIngredientAPIRequest $request)
    {
        $input = $request->all();

        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->create($input);

        return $this->sendResponse($nplanDayRecipeIngredient->toArray(), 'Nplan Day Recipe Ingredient saved successfully');
    }

    /**
     * Display the specified NplanDayRecipeIngredient.
     * GET|HEAD /nplan_day_recipe_ingredients/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var NplanDayRecipeIngredient $nplanDayRecipeIngredient */
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            return $this->sendError('Nplan Day Recipe Ingredient not found');
        }

        return $this->sendResponse($nplanDayRecipeIngredient->toArray(), 'Nplan Day Recipe Ingredient retrieved successfully');
    }

    /**
     * Update the specified NplanDayRecipeIngredient in storage.
     * PUT/PATCH /nplan_day_recipe_ingredients/{id}
     *
     * @param int $id
     * @param UpdateNplanDayRecipeIngredientAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateNplanDayRecipeIngredientAPIRequest $request)
    {
        $input = $request->all();

        /** @var NplanDayRecipeIngredient $nplanDayRecipeIngredient */
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            return $this->sendError('Nplan Day Recipe Ingredient not found');
        }

        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->update($input, $id);

        return $this->sendResponse($nplanDayRecipeIngredient->toArray(), 'NplanDayRecipeIngredient updated successfully');
    }

    /**
     * Remove the specified NplanDayRecipeIngredient from storage.
     * DELETE /nplan_day_recipe_ingredients/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var NplanDayRecipeIngredient $nplanDayRecipeIngredient */
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            return $this->sendError('Nplan Day Recipe Ingredient not found');
        }

        $nplanDayRecipeIngredient->delete();

        return $this->sendSuccess('Nplan Day Recipe Ingredient deleted successfully');
    }
}
