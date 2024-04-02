<?php

namespace App\Http\Controllers;

use App\DataTables\WorkoutPlanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWorkoutPlanRequest;
use App\Http\Requests\UpdateWorkoutPlanRequest;
use App\Repositories\WorkoutPlanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WorkoutPlanController extends AppBaseController
{
    /** @var WorkoutPlanRepository $workoutPlanRepository*/
    private $workoutPlanRepository;

    public function __construct(WorkoutPlanRepository $workoutPlanRepo)
    {
        $this->workoutPlanRepository = $workoutPlanRepo;
    }

    /**
     * Display a listing of the WorkoutPlan.
     *
     * @param WorkoutPlanDataTable $workoutPlanDataTable
     *
     * @return Response
     */
    public function index(WorkoutPlanDataTable $workoutPlanDataTable)
    {
        return $workoutPlanDataTable->render('workout_plans.index');
    }

    /**
     * Show the form for creating a new WorkoutPlan.
     *
     * @return Response
     */
    public function create()
    {
        return view('workout_plans.create');
    }

    /**
     * Store a newly created WorkoutPlan in storage.
     *
     * @param CreateWorkoutPlanRequest $request
     *
     * @return Response
     */
    public function store(CreateWorkoutPlanRequest $request)
    {
        $input = $request->all();

        $workoutPlan = $this->workoutPlanRepository->create($input);

        Flash::success('Workout Plan saved successfully.');

        return redirect(route('workout_plans.index'));
    }

    /**
     * Display the specified WorkoutPlan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            Flash::error('Workout Plan not found');

            return redirect(route('workout_plans.index'));
        }

        return view('workout_plans.show')->with('workoutPlan', $workoutPlan);
    }

    /**
     * Show the form for editing the specified WorkoutPlan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            Flash::error('Workout Plan not found');

            return redirect(route('workout_plans.index'));
        }

        return view('workout_plans.edit')->with('workoutPlan', $workoutPlan);
    }

    /**
     * Update the specified WorkoutPlan in storage.
     *
     * @param int $id
     * @param UpdateWorkoutPlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorkoutPlanRequest $request)
    {
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            Flash::error('Workout Plan not found');

            return redirect(route('workout_plans.index'));
        }

        $workoutPlan = $this->workoutPlanRepository->update($request->all(), $id);

        Flash::success('Workout Plan updated successfully.');

        return redirect(route('workout_plans.index'));
    }

    /**
     * Remove the specified WorkoutPlan from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            Flash::error('Workout Plan not found');

            return redirect(route('workout_plans.index'));
        }

        $this->workoutPlanRepository->delete($id);

        Flash::success('Workout Plan deleted successfully.');

        return redirect(route('workout_plans.index'));
    }
}
