<?php

namespace App\Http\Controllers\API;

use App\Criteria\WorkoutDayCriteria;
use App\Http\Requests\API\CreateWorkoutDayAPIRequest;
use App\Http\Requests\API\UpdateWorkoutDayAPIRequest;
use App\Http\Resources\SingleWorkoutDayResource;
use App\Http\Resources\SingleWorkoutDayResponse;
use App\Models\WorkoutDay;
use App\Repositories\WorkoutDayRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class WorkoutDayController
 * @package App\Http\Controllers\API
 */
class WorkoutDayAPIController extends AppBaseController
{
    /** @var  WorkoutDayRepository */
    private $workoutDayRepository;

    public function __construct(WorkoutDayRepository $workoutDayRepo)
    {
        $this->workoutDayRepository = $workoutDayRepo;
    }

    /**
     * Display a listing of the WorkoutDay.
     * GET|HEAD /workout_days
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $perPage      = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $workout_days = $this->workoutDayRepository->pushCriteria(new WorkoutDayCriteria($request->only([
            'workout_plan_id',
        ])));

        if ($request->input('paginate')) {
            $workout_days = $workout_days->paginate($perPage);
        } else {
            if ($request->input('get_dates')) {
                $workout_days = $workout_days->pluck('date');
            } else {
                $workout_days = $workout_days->all();
            }
        }

        return $this->sendResponse($workout_days->toArray(), 'Workout Days retrieved successfully');
    }

    /**
     * Store a newly created WorkoutDay in storage.
     * POST /workout_days
     *
     * @param CreateWorkoutDayAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateWorkoutDayAPIRequest $request)
    {
        $input = $request->all();

        $workoutDay = $this->workoutDayRepository->create($input);

        return $this->sendResponse($workoutDay->toArray(), 'Workout Day saved successfully');
    }

    /**
     * Display the specified WorkoutDay.
     * GET|HEAD /workout_days/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var WorkoutDay $workoutDay */
        $workoutDay = $this->workoutDayRepository->with('workoutDayExercises')->find($id);

        if (empty($workoutDay)) {
            return $this->sendError('Workout Day not found');
        }

        return $this->sendResponse(new SingleWorkoutDayResource($workoutDay), 'Workout Day retrieved successfully');
    }

    /**
     * Update the specified WorkoutDay in storage.
     * PUT/PATCH /workout_days/{id}
     *
     * @param int $id
     * @param UpdateWorkoutDayAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateWorkoutDayAPIRequest $request)
    {
        $input = $request->all();

        /** @var WorkoutDay $workoutDay */
        $workoutDay = $this->workoutDayRepository->find($id);

        if (empty($workoutDay)) {
            return $this->sendError('Workout Day not found');
        }

        $workoutDay = $this->workoutDayRepository->update($input, $id);

        return $this->sendResponse($workoutDay->toArray(), 'WorkoutDay updated successfully');
    }

    /**
     * Remove the specified WorkoutDay from storage.
     * DELETE /workout_days/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var WorkoutDay $workoutDay */
        $workoutDay = $this->workoutDayRepository->find($id);

        if (empty($workoutDay)) {
            return $this->sendError('Workout Day not found');
        }

        $workoutDay->delete();

        return $this->sendSuccess('Workout Day deleted successfully');
    }

    public function generateWorkoutPlan()
    {
        try {
            DB::beginTransaction();
            $user = \Auth::user()->details;
            if (!$user->goal) {
                return $this->sendError('Goal not set');
            }
            $workoutPlan = $this->workoutDayRepository->generateWorkoutPlan($user);
            DB::commit();
            return $this->sendResponse($workoutPlan->toArray(), 'Workout Plan generated successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            $this->sendError($exception->getMessage());
        }
    }
}
