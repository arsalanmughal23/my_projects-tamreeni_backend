<?php

namespace App\Http\Controllers;

use App\DataTables\MealDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Repositories\MealRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MealController extends AppBaseController
{
    /** @var MealRepository $mealRepository*/
    private $mealRepository;

    public function __construct(MealRepository $mealRepo)
    {
        $this->mealRepository = $mealRepo;
    }

    /**
     * Display a listing of the Meal.
     *
     * @param MealDataTable $mealDataTable
     *
     * @return Response
     */
    public function index(MealDataTable $mealDataTable)
    {
        return $mealDataTable->render('meals.index');
    }

    /**
     * Show the form for creating a new Meal.
     *
     * @return Response
     */
    public function create()
    {
        return view('meals.create');
    }

    /**
     * Store a newly created Meal in storage.
     *
     * @param CreateMealRequest $request
     *
     * @return Response
     */
    public function store(CreateMealRequest $request)
    {
        $input = $request->all();

        $meal = $this->mealRepository->create($input);

        Flash::success('Meal saved successfully.');

        return redirect(route('meals.index'));
    }

    /**
     * Display the specified Meal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            Flash::error('Meal not found');

            return redirect(route('meals.index'));
        }

        return view('meals.show')->with('meal', $meal);
    }

    /**
     * Show the form for editing the specified Meal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            Flash::error('Meal not found');

            return redirect(route('meals.index'));
        }

        return view('meals.edit')->with('meal', $meal);
    }

    /**
     * Update the specified Meal in storage.
     *
     * @param int $id
     * @param UpdateMealRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMealRequest $request)
    {
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            Flash::error('Meal not found');

            return redirect(route('meals.index'));
        }

        $meal = $this->mealRepository->update($request->all(), $id);

        Flash::success('Meal updated successfully.');

        return redirect(route('meals.index'));
    }

    /**
     * Remove the specified Meal from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $meal = $this->mealRepository->find($id);

        if (empty($meal)) {
            Flash::error('Meal not found');

            return redirect(route('meals.index'));
        }

        $this->mealRepository->delete($id);

        Flash::success('Meal deleted successfully.');

        return redirect(route('meals.index'));
    }
}
