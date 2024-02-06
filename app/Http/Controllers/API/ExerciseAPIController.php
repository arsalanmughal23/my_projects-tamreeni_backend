<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExerciseAPIRequest;
use App\Http\Requests\API\UpdateExerciseAPIRequest;
use App\Models\Exercise;
use App\Repositories\ExerciseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExerciseController
 * @package App\Http\Controllers\API
 */

class ExerciseAPIController extends AppBaseController
{
    /** @var  ExerciseRepository */
    private $exerciseRepository;

    public function __construct(ExerciseRepository $exerciseRepo)
    {
        $this->exerciseRepository = $exerciseRepo;
    }

    /**
     * Display a listing of the Exercise.
     * GET|HEAD /exercises
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $exercises = $this->exerciseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($exercises->toArray(), 'Exercises retrieved successfully');
    }

    /**
     * Store a newly created Exercise in storage.
     * POST /exercises
     *
     * @param CreateExerciseAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateExerciseAPIRequest $request)
    {
        $input = $request->all();

        $exercise = $this->exerciseRepository->create($input);

        return $this->sendResponse($exercise->toArray(), 'Exercise saved successfully');
    }

    /**
     * Display the specified Exercise.
     * GET|HEAD /exercises/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Exercise $exercise */
        $exercise = $this->exerciseRepository->exerciseDetails($id);

        if (empty($exercise)) {
            return $this->sendError('Exercise not found');
        }

        return $this->sendResponse($exercise->toArray(), 'Exercise retrieved successfully');
    }

    /**
     * Update the specified Exercise in storage.
     * PUT/PATCH /exercises/{id}
     *
     * @param int $id
     * @param UpdateExerciseAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateExerciseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Exercise $exercise */
        $exercise = $this->exerciseRepository->find($id);

        if (empty($exercise)) {
            return $this->sendError('Exercise not found');
        }

        $exercise = $this->exerciseRepository->update($input, $id);

        return $this->sendResponse($exercise->toArray(), 'Exercise updated successfully');
    }

    /**
     * Remove the specified Exercise from storage.
     * DELETE /exercises/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Exercise $exercise */
        $exercise = $this->exerciseRepository->find($id);

        if (empty($exercise)) {
            return $this->sendError('Exercise not found');
        }

        $exercise->delete();

        return $this->sendSuccess('Exercise deleted successfully');
    }
}
