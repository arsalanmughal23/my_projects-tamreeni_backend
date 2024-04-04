<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWorkoutPlanAPIRequest;
use App\Http\Requests\API\UpdateWorkoutPlanAPIRequest;
use App\Models\WorkoutPlan;
use App\Repositories\WorkoutPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class WorkoutPlanController
 * @package App\Http\Controllers\API
 */

class WorkoutPlanAPIController extends AppBaseController
{
    /** @var  WorkoutPlanRepository */
    private $workoutPlanRepository;

    public function __construct(WorkoutPlanRepository $workoutPlanRepo)
    {
        $this->workoutPlanRepository = $workoutPlanRepo;
    }

    /**
     * Display a listing of the WorkoutPlan.
     * GET|HEAD /workout_plans
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $workout_plans = $this->workoutPlanRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($workout_plans->toArray(), 'Workout Plans retrieved successfully');
    }

    /**
     * Store a newly created WorkoutPlan in storage.
     * POST /workout_plans
     *
     * @param CreateWorkoutPlanAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateWorkoutPlanAPIRequest $request)
    {
        $input = $request->all();

        $workoutPlan = $this->workoutPlanRepository->create($input);

        return $this->sendResponse($workoutPlan->toArray(), 'Workout Plan saved successfully');
    }

    /**
     * Display the specified WorkoutPlan.
     * GET|HEAD /workout_plans/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var WorkoutPlan $workoutPlan */
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            return $this->sendError('Workout Plan not found');
        }

        return $this->sendResponse($workoutPlan->toArray(), 'Workout Plan retrieved successfully');
    }

    /**
     * Update the specified WorkoutPlan in storage.
     * PUT/PATCH /workout_plans/{id}
     *
     * @param int $id
     * @param UpdateWorkoutPlanAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateWorkoutPlanAPIRequest $request)
    {
        $input = $request->all();

        /** @var WorkoutPlan $workoutPlan */
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            return $this->sendError('Workout Plan not found');
        }

        $workoutPlan = $this->workoutPlanRepository->update($input, $id);

        return $this->sendResponse($workoutPlan->toArray(), 'WorkoutPlan updated successfully');
    }

    /**
     * Remove the specified WorkoutPlan from storage.
     * DELETE /workout_plans/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var WorkoutPlan $workoutPlan */
        $workoutPlan = $this->workoutPlanRepository->find($id);

        if (empty($workoutPlan)) {
            return $this->sendError('Workout Plan not found');
        }

        $workoutPlan->delete();

        return $this->sendSuccess('Workout Plan deleted successfully');
    }
}
