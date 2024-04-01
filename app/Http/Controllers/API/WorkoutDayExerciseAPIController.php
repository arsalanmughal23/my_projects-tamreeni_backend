<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWorkoutDayExerciseAPIRequest;
use App\Http\Requests\API\UpdateWorkoutDayExerciseAPIRequest;
use App\Models\WorkoutDayExercise;
use App\Repositories\WorkoutDayExerciseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class WorkoutDayExerciseController
 * @package App\Http\Controllers\API
 */

class WorkoutDayExerciseAPIController extends AppBaseController
{
    /** @var  WorkoutDayExerciseRepository */
    private $workoutDayExerciseRepository;

    public function __construct(WorkoutDayExerciseRepository $workoutDayExerciseRepo)
    {
        $this->workoutDayExerciseRepository = $workoutDayExerciseRepo;
    }

    /**
     * Display a listing of the WorkoutDayExercise.
     * GET|HEAD /workout_day_exercises
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $workout_day_exercises = $this->workoutDayExerciseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($workout_day_exercises->toArray(), 'Workout Day Exercises retrieved successfully');
    }

    /**
     * Store a newly created WorkoutDayExercise in storage.
     * POST /workout_day_exercises
     *
     * @param CreateWorkoutDayExerciseAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateWorkoutDayExerciseAPIRequest $request)
    {
        $input = $request->all();

        $workoutDayExercise = $this->workoutDayExerciseRepository->create($input);

        return $this->sendResponse($workoutDayExercise->toArray(), 'Workout Day Exercise saved successfully');
    }

    /**
     * Display the specified WorkoutDayExercise.
     * GET|HEAD /workout_day_exercises/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var WorkoutDayExercise $workoutDayExercise */
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            return $this->sendError('Workout Day Exercise not found');
        }

        return $this->sendResponse($workoutDayExercise->toArray(), 'Workout Day Exercise retrieved successfully');
    }

    /**
     * Update the specified WorkoutDayExercise in storage.
     * PUT/PATCH /workout_day_exercises/{id}
     *
     * @param int $id
     * @param UpdateWorkoutDayExerciseAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateWorkoutDayExerciseAPIRequest $request)
    {
        $input = $request->all();

        /** @var WorkoutDayExercise $workoutDayExercise */
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            return $this->sendError('Workout Day Exercise not found');
        }

        $workoutDayExercise = $this->workoutDayExerciseRepository->update($input, $id);

        return $this->sendResponse($workoutDayExercise->toArray(), 'WorkoutDayExercise updated successfully');
    }

    /**
     * Remove the specified WorkoutDayExercise from storage.
     * DELETE /workout_day_exercises/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var WorkoutDayExercise $workoutDayExercise */
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            return $this->sendError('Workout Day Exercise not found');
        }

        $workoutDayExercise->delete();

        return $this->sendSuccess('Workout Day Exercise deleted successfully');
    }
}
