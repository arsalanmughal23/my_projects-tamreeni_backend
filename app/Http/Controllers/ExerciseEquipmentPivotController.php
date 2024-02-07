<?php

namespace App\Http\Controllers;

use App\DataTables\ExerciseEquipmentPivotDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExerciseEquipmentPivotRequest;
use App\Http\Requests\UpdateExerciseEquipmentPivotRequest;
use App\Repositories\ExerciseEquipmentPivotRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExerciseEquipmentPivotController extends AppBaseController
{
    /** @var ExerciseEquipmentPivotRepository $exerciseEquipmentPivotRepository*/
    private $exerciseEquipmentPivotRepository;

    public function __construct(ExerciseEquipmentPivotRepository $exerciseEquipmentPivotRepo)
    {
        $this->exerciseEquipmentPivotRepository = $exerciseEquipmentPivotRepo;
    }

    /**
     * Display a listing of the ExerciseEquipmentPivot.
     *
     * @param ExerciseEquipmentPivotDataTable $exerciseEquipmentPivotDataTable
     *
     * @return Response
     */
    public function index(ExerciseEquipmentPivotDataTable $exerciseEquipmentPivotDataTable)
    {
        return $exerciseEquipmentPivotDataTable->render('exercise_equipment_pivots.index');
    }

    /**
     * Show the form for creating a new ExerciseEquipmentPivot.
     *
     * @return Response
     */
    public function create()
    {
        return view('exercise_equipment_pivots.create');
    }

    /**
     * Store a newly created ExerciseEquipmentPivot in storage.
     *
     * @param CreateExerciseEquipmentPivotRequest $request
     *
     * @return Response
     */
    public function store(CreateExerciseEquipmentPivotRequest $request)
    {
        $input = $request->all();

        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->create($input);

        Flash::success('Exercise Equipment Pivot saved successfully.');

        return redirect(route('exercise_equipment_pivots.index'));
    }

    /**
     * Display the specified ExerciseEquipmentPivot.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            Flash::error('Exercise Equipment Pivot not found');

            return redirect(route('exercise_equipment_pivots.index'));
        }

        return view('exercise_equipment_pivots.show')->with('exerciseEquipmentPivot', $exerciseEquipmentPivot);
    }

    /**
     * Show the form for editing the specified ExerciseEquipmentPivot.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            Flash::error('Exercise Equipment Pivot not found');

            return redirect(route('exercise_equipment_pivots.index'));
        }

        return view('exercise_equipment_pivots.edit')->with('exerciseEquipmentPivot', $exerciseEquipmentPivot);
    }

    /**
     * Update the specified ExerciseEquipmentPivot in storage.
     *
     * @param int $id
     * @param UpdateExerciseEquipmentPivotRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExerciseEquipmentPivotRequest $request)
    {
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            Flash::error('Exercise Equipment Pivot not found');

            return redirect(route('exercise_equipment_pivots.index'));
        }

        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->update($request->all(), $id);

        Flash::success('Exercise Equipment Pivot updated successfully.');

        return redirect(route('exercise_equipment_pivots.index'));
    }

    /**
     * Remove the specified ExerciseEquipmentPivot from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exerciseEquipmentPivot = $this->exerciseEquipmentPivotRepository->find($id);

        if (empty($exerciseEquipmentPivot)) {
            Flash::error('Exercise Equipment Pivot not found');

            return redirect(route('exercise_equipment_pivots.index'));
        }

        $this->exerciseEquipmentPivotRepository->delete($id);

        Flash::success('Exercise Equipment Pivot deleted successfully.');

        return redirect(route('exercise_equipment_pivots.index'));
    }
}
