<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExerciseEquipmentPivotAPIRequest;
use App\Http\Requests\API\UpdateExerciseEquipmentPivotAPIRequest;
use App\Models\ExerciseEquipmentPivot;
use App\Repositories\ExerciseEquipmentPivotRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExerciseEquipmentPivotController
 * @package App\Http\Controllers\API
 */

class ExerciseEquipmentPivotAPIController extends AppBaseController
{
    /** @var  ExerciseEquipmentPivotRepository */
    private $exerciseEquipmentPivotRepository;

    public function __construct(ExerciseEquipmentPivotRepository $exerciseEquipmentPivotRepo)
    {
        $this->exerciseEquipmentPivotRepository = $exerciseEquipmentPivotRepo;
    }

    /**
     * Display a listing of the ExerciseEquipmentPivot.
     * GET|HEAD /exercise_equipment_pivots
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $exercise_equipment_pivots = $this->exerciseEquipmentPivotRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($exercise_equipment_pivots->toArray(), 'Exercise Equipment Pivots retrieved successfully');
    }

    /**
     * Store a newly created ExerciseEquipmentPivot in storage.
     * POST /exercise_equipment_pivots
     *
     * @param CreateExerciseEquipmentPivotAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateExerciseEquipmentPivotAPIRequest $request)
    {
        $input = $request->all();

        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->create($input);

        return $this->sendResponse($exerciseEquipmentPivot->toArray(), 'Exercise Equipment Pivot saved successfully');
    }

    /**
     * Display the specified ExerciseEquipmentPivot.
     * GET|HEAD /exercise_equipment_pivots/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var ExerciseEquipmentPivot $exerciseEquipmentPivot */
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            return $this->sendError('Exercise Equipment Pivot not found');
        }

        return $this->sendResponse($exerciseEquipmentPivot->toArray(), 'Exercise Equipment Pivot retrieved successfully');
    }

    /**
     * Update the specified ExerciseEquipmentPivot in storage.
     * PUT/PATCH /exercise_equipment_pivots/{id}
     *
     * @param int $id
     * @param UpdateExerciseEquipmentPivotAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateExerciseEquipmentPivotAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExerciseEquipmentPivot $exerciseEquipmentPivot */
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            return $this->sendError('Exercise Equipment Pivot not found');
        }

        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->update($input, $id);

        return $this->sendResponse($exerciseEquipmentPivot->toArray(), 'ExerciseEquipmentPivot updated successfully');
    }

    /**
     * Remove the specified ExerciseEquipmentPivot from storage.
     * DELETE /exercise_equipment_pivots/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var ExerciseEquipmentPivot $exerciseEquipmentPivot */
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            return $this->sendError('Exercise Equipment Pivot not found');
        }

        $exerciseEquipmentPivot->delete();

        return $this->sendSuccess('Exercise Equipment Pivot deleted successfully');
    }
}
