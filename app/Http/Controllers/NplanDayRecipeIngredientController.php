<?php

namespace App\Http\Controllers;

use App\DataTables\NplanDayRecipeIngredientDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNplanDayRecipeIngredientRequest;
use App\Http\Requests\UpdateNplanDayRecipeIngredientRequest;
use App\Repositories\NplanDayRecipeIngredientRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NplanDayRecipeIngredientController extends AppBaseController
{
    /** @var NplanDayRecipeIngredientRepository $nplanDayRecipeIngredientRepository*/
    private $nplanDayRecipeIngredientRepository;

    public function __construct(NplanDayRecipeIngredientRepository $nplanDayRecipeIngredientRepo)
    {
        $this->nplanDayRecipeIngredientRepository = $nplanDayRecipeIngredientRepo;
    }

    /**
     * Display a listing of the NplanDayRecipeIngredient.
     *
     * @param NplanDayRecipeIngredientDataTable $nplanDayRecipeIngredientDataTable
     *
     * @return Response
     */
    public function index(NplanDayRecipeIngredientDataTable $nplanDayRecipeIngredientDataTable)
    {
        return $nplanDayRecipeIngredientDataTable->render('nplan_day_recipe_ingredients.index');
    }

    /**
     * Show the form for creating a new NplanDayRecipeIngredient.
     *
     * @return Response
     */
    public function create()
    {
        return view('nplan_day_recipe_ingredients.create');
    }

    /**
     * Store a newly created NplanDayRecipeIngredient in storage.
     *
     * @param CreateNplanDayRecipeIngredientRequest $request
     *
     * @return Response
     */
    public function store(CreateNplanDayRecipeIngredientRequest $request)
    {
        $input = $request->all();

        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->create($input);

        Flash::success('Nplan Day Recipe Ingredient saved successfully.');

        return redirect(route('nplan_day_recipe_ingredients.index'));
    }

    /**
     * Display the specified NplanDayRecipeIngredient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            Flash::error('Nplan Day Recipe Ingredient not found');

            return redirect(route('nplan_day_recipe_ingredients.index'));
        }

        return view('nplan_day_recipe_ingredients.show')->with('nplanDayRecipeIngredient', $nplanDayRecipeIngredient);
    }

    /**
     * Show the form for editing the specified NplanDayRecipeIngredient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            Flash::error('Nplan Day Recipe Ingredient not found');

            return redirect(route('nplan_day_recipe_ingredients.index'));
        }

        return view('nplan_day_recipe_ingredients.edit')->with('nplanDayRecipeIngredient', $nplanDayRecipeIngredient);
    }

    /**
     * Update the specified NplanDayRecipeIngredient in storage.
     *
     * @param int $id
     * @param UpdateNplanDayRecipeIngredientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNplanDayRecipeIngredientRequest $request)
    {
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            Flash::error('Nplan Day Recipe Ingredient not found');

            return redirect(route('nplan_day_recipe_ingredients.index'));
        }

        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->update($request->all(), $id);

        Flash::success('Nplan Day Recipe Ingredient updated successfully.');

        return redirect(route('nplan_day_recipe_ingredients.index'));
    }

    /**
     * Remove the specified NplanDayRecipeIngredient from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepository->find($id);

        if (empty($nplanDayRecipeIngredient)) {
            Flash::error('Nplan Day Recipe Ingredient not found');

            return redirect(route('nplan_day_recipe_ingredients.index'));
        }

        $this->nplanDayRecipeIngredientRepository->delete($id);

        Flash::success('Nplan Day Recipe Ingredient deleted successfully.');

        return redirect(route('nplan_day_recipe_ingredients.index'));
    }
}
