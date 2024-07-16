<?php

namespace App\Http\Controllers;

use App\DataTables\MealBreakdownDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMealBreakdownRequest;
use App\Http\Requests\UpdateMealBreakdownRequest;
use App\Repositories\MealBreakdownRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MealBreakdownController extends AppBaseController
{
    /** @var MealBreakdownRepository $mealBreakdownRepository*/
    private $mealBreakdownRepository;

    public function __construct(MealBreakdownRepository $mealBreakdownRepo)
    {
        $this->mealBreakdownRepository = $mealBreakdownRepo;
    }

    /**
     * Display a listing of the MealBreakdown.
     *
     * @param MealBreakdownDataTable $mealBreakdownDataTable
     *
     * @return Response
     */
    public function index(MealBreakdownDataTable $mealBreakdownDataTable)
    {
        return $mealBreakdownDataTable->render('meal_breakdowns.index');
    }

    /**
     * Show the form for creating a new MealBreakdown.
     *
     * @return Response
     */
    public function create()
    {
        return view('meal_breakdowns.create');
    }

    /**
     * Store a newly created MealBreakdown in storage.
     *
     * @param CreateMealBreakdownRequest $request
     *
     * @return Response
     */
    public function store(CreateMealBreakdownRequest $request)
    {
        $input = $request->all();

        $mealBreakdown = $this->mealBreakdownRepository->create($input);

        Flash::success('Meal Breakdown saved successfully.');

        return redirect(route('meal_breakdowns.index'));
    }

    /**
     * Display the specified MealBreakdown.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            Flash::error('Meal Breakdown not found');

            return redirect(route('meal_breakdowns.index'));
        }

        return view('meal_breakdowns.show')->with('mealBreakdown', $mealBreakdown);
    }

    /**
     * Show the form for editing the specified MealBreakdown.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            Flash::error('Meal Breakdown not found');

            return redirect(route('meal_breakdowns.index'));
        }

        return view('meal_breakdowns.edit')->with('mealBreakdown', $mealBreakdown);
    }

    /**
     * Update the specified MealBreakdown in storage.
     *
     * @param int $id
     * @param UpdateMealBreakdownRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMealBreakdownRequest $request)
    {
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            Flash::error('Meal Breakdown not found');

            return redirect(route('meal_breakdowns.index'));
        }
        $mealBreakdown = $this->mealBreakdownRepository->update($request->all(), $id);
        Flash::success('Meal Breakdown updated successfully.');

        return redirect(route('meal_breakdowns.index'));
    }

    /**
     * Remove the specified MealBreakdown from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mealBreakdown = $this->mealBreakdownRepository->find($id);

        if (empty($mealBreakdown)) {
            Flash::error('Meal Breakdown not found');

            return redirect(route('meal_breakdowns.index'));
        }

        $this->mealBreakdownRepository->delete($id);

        Flash::success('Meal Breakdown deleted successfully.');

        return redirect(route('meal_breakdowns.index'));
    }
}
