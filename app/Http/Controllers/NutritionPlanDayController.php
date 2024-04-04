<?php

namespace App\Http\Controllers;

use App\DataTables\NutritionPlanDayDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNutritionPlanDayRequest;
use App\Http\Requests\UpdateNutritionPlanDayRequest;
use App\Repositories\NutritionPlanDayRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NutritionPlanDayController extends AppBaseController
{
    /** @var NutritionPlanDayRepository $nutritionPlanDayRepository*/
    private $nutritionPlanDayRepository;

    public function __construct(NutritionPlanDayRepository $nutritionPlanDayRepo)
    {
        $this->nutritionPlanDayRepository = $nutritionPlanDayRepo;
    }

    /**
     * Display a listing of the NutritionPlanDay.
     *
     * @param NutritionPlanDayDataTable $nutritionPlanDayDataTable
     *
     * @return Response
     */
    public function index(NutritionPlanDayDataTable $nutritionPlanDayDataTable)
    {
        return $nutritionPlanDayDataTable->render('nutrition_plan_days.index');
    }

    /**
     * Show the form for creating a new NutritionPlanDay.
     *
     * @return Response
     */
    public function create()
    {
        return view('nutrition_plan_days.create');
    }

    /**
     * Store a newly created NutritionPlanDay in storage.
     *
     * @param CreateNutritionPlanDayRequest $request
     *
     * @return Response
     */
    public function store(CreateNutritionPlanDayRequest $request)
    {
        $input = $request->all();

        $nutritionPlanDay = $this->nutritionPlanDayRepository->create($input);

        Flash::success('Nutrition Plan Day saved successfully.');

        return redirect(route('nutrition_plan_days.index'));
    }

    /**
     * Display the specified NutritionPlanDay.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            Flash::error('Nutrition Plan Day not found');

            return redirect(route('nutrition_plan_days.index'));
        }

        return view('nutrition_plan_days.show')->with('nutritionPlanDay', $nutritionPlanDay);
    }

    /**
     * Show the form for editing the specified NutritionPlanDay.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            Flash::error('Nutrition Plan Day not found');

            return redirect(route('nutrition_plan_days.index'));
        }

        return view('nutrition_plan_days.edit')->with('nutritionPlanDay', $nutritionPlanDay);
    }

    /**
     * Update the specified NutritionPlanDay in storage.
     *
     * @param int $id
     * @param UpdateNutritionPlanDayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNutritionPlanDayRequest $request)
    {
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            Flash::error('Nutrition Plan Day not found');

            return redirect(route('nutrition_plan_days.index'));
        }

        $nutritionPlanDay = $this->nutritionPlanDayRepository->update($request->all(), $id);

        Flash::success('Nutrition Plan Day updated successfully.');

        return redirect(route('nutrition_plan_days.index'));
    }

    /**
     * Remove the specified NutritionPlanDay from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionPlanDay = $this->nutritionPlanDayRepository->find($id);

        if (empty($nutritionPlanDay)) {
            Flash::error('Nutrition Plan Day not found');

            return redirect(route('nutrition_plan_days.index'));
        }

        $this->nutritionPlanDayRepository->delete($id);

        Flash::success('Nutrition Plan Day deleted successfully.');

        return redirect(route('nutrition_plan_days.index'));
    }
}
