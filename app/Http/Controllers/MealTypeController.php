<?php

namespace App\Http\Controllers;

use App\DataTables\MealTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMealTypeRequest;
use App\Http\Requests\UpdateMealTypeRequest;
use App\Repositories\MealTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MealTypeController extends AppBaseController
{
    /** @var MealTypeRepository $mealTypeRepository*/
    private $mealTypeRepository;

    public function __construct(MealTypeRepository $mealTypeRepo)
    {
        $this->mealTypeRepository = $mealTypeRepo;
    }

    /**
     * Display a listing of the MealType.
     *
     * @param MealTypeDataTable $mealTypeDataTable
     *
     * @return Response
     */
    public function index(MealTypeDataTable $mealTypeDataTable)
    {
        return $mealTypeDataTable->render('meal_types.index');
    }

    /**
     * Show the form for creating a new MealType.
     *
     * @return Response
     */
    public function create()
    {
        return view('meal_types.create');
    }

    /**
     * Store a newly created MealType in storage.
     *
     * @param CreateMealTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateMealTypeRequest $request)
    {
        $input = $request->all();

        $mealType = $this->mealTypeRepository->create($input);

        Flash::success('Meal Type saved successfully.');

        return redirect(route('meal_types.index'));
    }

    /**
     * Display the specified MealType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error('Meal Type not found');

            return redirect(route('meal_types.index'));
        }

        return view('meal_types.show')->with('mealType', $mealType);
    }

    /**
     * Show the form for editing the specified MealType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error('Meal Type not found');

            return redirect(route('meal_types.index'));
        }

        return view('meal_types.edit')->with('mealType', $mealType);
    }

    /**
     * Update the specified MealType in storage.
     *
     * @param int $id
     * @param UpdateMealTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMealTypeRequest $request)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error('Meal Type not found');

            return redirect(route('meal_types.index'));
        }

        $mealType = $this->mealTypeRepository->update($request->all(), $id);

        Flash::success('Meal Type updated successfully.');

        return redirect(route('meal_types.index'));
    }

    /**
     * Remove the specified MealType from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mealType = $this->mealTypeRepository->find($id);

        if (empty($mealType)) {
            Flash::error('Meal Type not found');

            return redirect(route('meal_types.index'));
        }

        $this->mealTypeRepository->delete($id);

        Flash::success('Meal Type deleted successfully.');

        return redirect(route('meal_types.index'));
    }
}
