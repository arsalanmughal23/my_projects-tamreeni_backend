<?php

namespace App\Http\Controllers;

use App\DataTables\ExerciseEquipmentDataTable;
use App\Helper\FileHelper;
use App\Http\Requests;
use App\Http\Requests\CreateExerciseEquipmentRequest;
use App\Http\Requests\UpdateExerciseEquipmentRequest;
use App\Repositories\ExerciseEquipmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExerciseEquipmentController extends AppBaseController
{
    /** @var ExerciseEquipmentRepository $exerciseEquipmentRepository */
    private $exerciseEquipmentRepository;

    public function __construct(ExerciseEquipmentRepository $exerciseEquipmentRepo)
    {
        $this->exerciseEquipmentRepository = $exerciseEquipmentRepo;
    }

    /**
     * Display a listing of the ExerciseEquipment.
     *
     * @param ExerciseEquipmentDataTable $exerciseEquipmentDataTable
     *
     * @return Response
     */
    public function index(ExerciseEquipmentDataTable $exerciseEquipmentDataTable)
    {
        return $exerciseEquipmentDataTable->render('exercise_equipments.index');
    }

    /**
     * Show the form for creating a new ExerciseEquipment.
     *
     * @return Response
     */
    public function create()
    {
        return view('exercise_equipments.create');
    }

    /**
     * Store a newly created ExerciseEquipment in storage.
     *
     * @param CreateExerciseEquipmentRequest $request
     *
     * @return Response
     */
    public function store(CreateExerciseEquipmentRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $input['icon'] = FileHelper::s3Upload($input['image']);
        }

        $exerciseEquipment = $this->exerciseEquipmentRepository->create($input);

        Flash::success('Exercise Equipment saved successfully.');

        return redirect(route('exercise_equipments.index'));
    }

    /**
     * Display the specified ExerciseEquipment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        if (empty($exerciseEquipment)) {
            Flash::error('Exercise Equipment not found');

            return redirect(route('exercise_equipments.index'));
        }

        return view('exercise_equipments.show')->with('exerciseEquipment', $exerciseEquipment);
    }

    /**
     * Show the form for editing the specified ExerciseEquipment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        if (empty($exerciseEquipment)) {
            Flash::error('Exercise Equipment not found');

            return redirect(route('exercise_equipments.index'));
        }

        return view('exercise_equipments.edit')->with('exerciseEquipment', $exerciseEquipment);
    }

    /**
     * Update the specified ExerciseEquipment in storage.
     *
     * @param int $id
     * @param UpdateExerciseEquipmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExerciseEquipmentRequest $request)
    {
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        $input = $request->all();

        if (empty($exerciseEquipment)) {
            Flash::error('Exercise Equipment not found');

            return redirect(route('exercise_equipments.index'));
        }

        if ($request->hasFile('image')) {
            $input['icon'] = FileHelper::s3Upload($input['image']);
        }

        $exerciseEquipment = $this->exerciseEquipmentRepository->update($input, $id);

        Flash::success('Exercise Equipment updated successfully.');

        return redirect(route('exercise_equipments.index'));
    }

    /**
     * Remove the specified ExerciseEquipment from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exerciseEquipment = $this->exerciseEquipmentRepository->find($id);

        if (empty($exerciseEquipment)) {
            Flash::error('Exercise Equipment not found');

            return redirect(route('exercise_equipments.index'));
        }

        $this->exerciseEquipmentRepository->delete($id);

        Flash::success('Exercise Equipment deleted successfully.');

        return redirect(route('exercise_equipments.index'));
    }
}
