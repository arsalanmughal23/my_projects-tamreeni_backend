<?php

namespace App\Http\Controllers;

use App\DataTables\WorkoutDayExerciseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWorkoutDayExerciseRequest;
use App\Http\Requests\UpdateWorkoutDayExerciseRequest;
use App\Repositories\WorkoutDayExerciseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WorkoutDayExerciseController extends AppBaseController
{
    /** @var WorkoutDayExerciseRepository $workoutDayExerciseRepository*/
    private $workoutDayExerciseRepository;

    public function __construct(WorkoutDayExerciseRepository $workoutDayExerciseRepo)
    {
        $this->workoutDayExerciseRepository = $workoutDayExerciseRepo;
    }

    /**
     * Display a listing of the WorkoutDayExercise.
     *
     * @param WorkoutDayExerciseDataTable $workoutDayExerciseDataTable
     *
     * @return Response
     */
    public function index(WorkoutDayExerciseDataTable $workoutDayExerciseDataTable)
    {
        return $workoutDayExerciseDataTable->render('workout_day_exercises.index');
    }

    /**
     * Show the form for creating a new WorkoutDayExercise.
     *
     * @return Response
     */
    public function create()
    {
        return view('workout_day_exercises.create');
    }

    /**
     * Store a newly created WorkoutDayExercise in storage.
     *
     * @param CreateWorkoutDayExerciseRequest $request
     *
     * @return Response
     */
    public function store(CreateWorkoutDayExerciseRequest $request)
    {
        $input = $request->all();

        $workoutDayExercise = $this->workoutDayExerciseRepository->create($input);

        Flash::success('Workout Day Exercise saved successfully.');

        return redirect(route('workout_day_exercises.index'));
    }

    /**
     * Display the specified WorkoutDayExercise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            Flash::error('Workout Day Exercise not found');

            return redirect(route('workout_day_exercises.index'));
        }

        return view('workout_day_exercises.show')->with('workoutDayExercise', $workoutDayExercise);
    }

    /**
     * Show the form for editing the specified WorkoutDayExercise.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            Flash::error('Workout Day Exercise not found');

            return redirect(route('workout_day_exercises.index'));
        }

        return view('workout_day_exercises.edit')->with('workoutDayExercise', $workoutDayExercise);
    }

    /**
     * Update the specified WorkoutDayExercise in storage.
     *
     * @param int $id
     * @param UpdateWorkoutDayExerciseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorkoutDayExerciseRequest $request)
    {
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            Flash::error('Workout Day Exercise not found');

            return redirect(route('workout_day_exercises.index'));
        }

        $workoutDayExercise = $this->workoutDayExerciseRepository->update($request->all(), $id);

        Flash::success('Workout Day Exercise updated successfully.');

        return redirect(route('workout_day_exercises.index'));
    }

    /**
     * Remove the specified WorkoutDayExercise from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $workoutDayExercise = $this->workoutDayExerciseRepository->find($id);

        if (empty($workoutDayExercise)) {
            Flash::error('Workout Day Exercise not found');

            return redirect(route('workout_day_exercises.index'));
        }

        $this->workoutDayExerciseRepository->delete($id);

        Flash::success('Workout Day Exercise deleted successfully.');

        return redirect(route('workout_day_exercises.index'));
    }
}
