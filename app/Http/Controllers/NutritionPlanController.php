<?php

namespace App\Http\Controllers;

use App\DataTables\NutritionPlanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNutritionPlanRequest;
use App\Http\Requests\UpdateNutritionPlanRequest;
use App\Repositories\NutritionPlanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NutritionPlanController extends AppBaseController
{
    /** @var NutritionPlanRepository $nutritionPlanRepository*/
    private $nutritionPlanRepository;

    public function __construct(NutritionPlanRepository $nutritionPlanRepo)
    {
        $this->nutritionPlanRepository = $nutritionPlanRepo;
    }

    /**
     * Display a listing of the NutritionPlan.
     *
     * @param NutritionPlanDataTable $nutritionPlanDataTable
     *
     * @return Response
     */
    public function index(NutritionPlanDataTable $nutritionPlanDataTable)
    {
        return $nutritionPlanDataTable->render('nutrition_plans.index');
    }

    /**
     * Show the form for creating a new NutritionPlan.
     *
     * @return Response
     */
    public function create()
    {
        return view('nutrition_plans.create');
    }

    /**
     * Store a newly created NutritionPlan in storage.
     *
     * @param CreateNutritionPlanRequest $request
     *
     * @return Response
     */
    public function store(CreateNutritionPlanRequest $request)
    {
        $input = $request->all();

        $nutritionPlan = $this->nutritionPlanRepository->create($input);

        Flash::success('Nutrition Plan saved successfully.');

        return redirect(route('nutrition_plans.index'));
    }

    /**
     * Display the specified NutritionPlan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            Flash::error('Nutrition Plan not found');

            return redirect(route('nutrition_plans.index'));
        }

        return view('nutrition_plans.show')->with('nutritionPlan', $nutritionPlan);
    }

    /**
     * Show the form for editing the specified NutritionPlan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            Flash::error('Nutrition Plan not found');

            return redirect(route('nutrition_plans.index'));
        }

        return view('nutrition_plans.edit')->with('nutritionPlan', $nutritionPlan);
    }

    /**
     * Update the specified NutritionPlan in storage.
     *
     * @param int $id
     * @param UpdateNutritionPlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNutritionPlanRequest $request)
    {
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            Flash::error('Nutrition Plan not found');

            return redirect(route('nutrition_plans.index'));
        }

        $nutritionPlan = $this->nutritionPlanRepository->update($request->all(), $id);

        Flash::success('Nutrition Plan updated successfully.');

        return redirect(route('nutrition_plans.index'));
    }

    /**
     * Remove the specified NutritionPlan from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nutritionPlan = $this->nutritionPlanRepository->find($id);

        if (empty($nutritionPlan)) {
            Flash::error('Nutrition Plan not found');

            return redirect(route('nutrition_plans.index'));
        }

        $this->nutritionPlanRepository->delete($id);

        Flash::success('Nutrition Plan deleted successfully.');

        return redirect(route('nutrition_plans.index'));
    }
}
