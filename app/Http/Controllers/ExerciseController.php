<?php

namespace App\Http\Controllers;

use App\DataTables\ExerciseDataTable;
use App\Helper\FileHelper;
use App\Http\Requests;
use App\Http\Requests\CreateExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\BodyPart;
use App\Models\ExerciseEquipment;
use App\Repositories\ExerciseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExerciseController extends AppBaseController
{
    /** @var ExerciseRepository $exerciseRepository */
    private $exerciseRepository;

    public function __construct(ExerciseRepository $exerciseRepo)
    {
        $this->exerciseRepository = $exerciseRepo;
    }

    /**
     * Display a listing of the Exercise.
     *
     * @param ExerciseDataTable $exerciseDataTable
     *
     * @return Response
     */
    public function index(ExerciseDataTable $exerciseDataTable)
    {
        $bodyParts           = BodyPart::all();
        $exercise_equipments = ExerciseEquipment::all();

        return $exerciseDataTable->render('exercises.index', ['bodyParts' => $bodyParts, 'exercise_equipments' => $exercise_equipments]);
    }

    /**
     * Show the form for creating a new Exercise.
     *
     * @return Response
     */
    public function create()
    {
//        dd("asdad");
        $bodyParts           = BodyPart::all();
        $exercise_equipments = ExerciseEquipment::all()->pluck('name', 'id');

        return view('exercises.create')->with(['bodyParts' => $bodyParts, 'exercise_equipments' => $exercise_equipments]);
    }

    /**
     * Store a newly created Exercise in storage.
     *
     * @param CreateExerciseRequest $request
     *
     * @return Response
     */
    public function store(CreateExerciseRequest $request)
    {
        $input = $request->all();

        $input['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
//            $input['image'] = FileHelper::s3Upload($input['image']);
        }
        dd($input, $request->hasFile('video'));

        if ($request->hasFile('video')) {
//            dd($input);
            $input['video'] = FileHelper::s3Upload($input['video']);
            dd($input['video']);
        }

        dd($input['video']);

        $exercise = $this->exerciseRepository->create($input);

        if (isset($input['exercise_equipments'])) {
            $equipmentIds = $input['exercise_equipments'];
            $exercise->equipment()->attach($equipmentIds);
        }

        Flash::success('Exercise saved successfully.');

        return redirect(route('exercises.index'));
    }

    /**
     * Display the specified Exercise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exercise = $this->exerciseRepository->find($id);

        if (empty($exercise)) {
            Flash::error('Exercise not found');

            return redirect(route('exercises.index'));
        }

        return view('exercises.show')->with('exercise', $exercise);
    }

    /**
     * Show the form for editing the specified Exercise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exercise            = $this->exerciseRepository->find($id);
        $bodyParts           = BodyPart::all();
        $exercise_equipments = ExerciseEquipment::all()->pluck('name', 'id');

        $selectedEquipments = $exercise->equipment->pluck('id')->toArray();

        if (empty($exercise)) {
            Flash::error('Exercise not found');

            return redirect(route('exercises.index'));
        }

        return view('exercises.edit')->with(['exercise' => $exercise, 'bodyParts' => $bodyParts, 'exercise_equipments' => $exercise_equipments, 'selectedEquipments' => $selectedEquipments]);
    }

    /**
     * Update the specified Exercise in storage.
     *
     * @param int $id
     * @param UpdateExerciseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExerciseRequest $request)
    {
        $exercise = $this->exerciseRepository->find($id);
        $input    = $request->all();
        if (empty($exercise)) {
            Flash::error('Exercise not found');

            return redirect(route('exercises.index'));
        }

        if ($request->hasFile('image')) {
            $input['image'] = FileHelper::s3Upload($input['image']);
        }

        if ($request->hasFile('video')) {
            $input['video'] = FileHelper::s3Upload($input['video']);
        }

        $this->exerciseRepository->update($input, $id);

        if (isset($input['exercise_equipments'])) {
            $equipmentIds = $input['exercise_equipments'];
            $exercise->equipment()->sync($equipmentIds);
        }

        Flash::success('Exercise updated successfully.');

        return redirect(route('exercises.index'));
    }

    /**
     * Remove the specified Exercise from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exercise = $this->exerciseRepository->find($id);

        if (empty($exercise)) {
            Flash::error('Exercise not found');

            return redirect(route('exercises.index'));
        }

        $this->exerciseRepository->delete($id);

        Flash::success('Exercise deleted successfully.');

        return redirect(route('exercises.index'));
    }
}
