<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExerciseEquipmentAPIRequest;
use App\Http\Requests\API\UpdateExerciseEquipmentAPIRequest;
use App\Models\ExerciseEquipment;
use App\Repositories\ExerciseEquipmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExerciseEquipmentController
 * @package App\Http\Controllers\API
 */

class ExerciseEquipmentAPIController extends AppBaseController
{
    /** @var  ExerciseEquipmentRepository */
    private $exerciseEquipmentRepository;

    public function __construct(ExerciseEquipmentRepository $exerciseEquipmentRepo)
    {
        $this->exerciseEquipmentRepository = $exerciseEquipmentRepo;
    }

    /**
     * Display a listing of the ExerciseEquipment.
     * GET|HEAD /exercise_equipments
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $exercise_equipments = $this->exerciseEquipmentRepository->all();

        return $this->sendResponse($exercise_equipments->toArray(), 'Exercise Equipments retrieved successfully');
    }

    /**
     * Store a newly created ExerciseEquipment in storage.
     * POST /exercise_equipments
     *
     * @param CreateExerciseEquipmentAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateExerciseEquipmentAPIRequest $request)
    {
        $input = $request->all();

        $exerciseEquipment = $this->exerciseEquipmentRepository->create($input);

        return $this->sendResponse($exerciseEquipment->toArray(), 'Exercise Equipment saved successfully');
    }

    /**
     * Display the specified ExerciseEquipment.
     * GET|HEAD /exercise_equipments/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var ExerciseEquipment $exerciseEquipment */
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        if (empty($exerciseEquipment)) {
            return $this->sendError('Exercise Equipment not found');
        }

        return $this->sendResponse($exerciseEquipment->toArray(), 'Exercise Equipment retrieved successfully');
    }

    /**
     * Update the specified ExerciseEquipment in storage.
     * PUT/PATCH /exercise_equipments/{id}
     *
     * @param int $id
     * @param UpdateExerciseEquipmentAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateExerciseEquipmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExerciseEquipment $exerciseEquipment */
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        if (empty($exerciseEquipment)) {
            return $this->sendError('Exercise Equipment not found');
        }

        $exerciseEquipment = $this->exerciseEquipmentRepository->update($input, $id);

        return $this->sendResponse($exerciseEquipment->toArray(), 'ExerciseEquipment updated successfully');
    }

    /**
     * Remove the specified ExerciseEquipment from storage.
     * DELETE /exercise_equipments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var ExerciseEquipment $exerciseEquipment */
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        if (empty($exerciseEquipment)) {
            return $this->sendError('Exercise Equipment not found');
        }

        $exerciseEquipment->delete();

        return $this->sendSuccess('Exercise Equipment deleted successfully');
    }
}
