<?php

namespace App\Http\Controllers;

use App\DataTables\WorkoutDayDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWorkoutDayRequest;
use App\Http\Requests\UpdateWorkoutDayRequest;
use App\Repositories\WorkoutDayRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WorkoutDayController extends AppBaseController
{
    /** @var WorkoutDayRepository $workoutDayRepository*/
    private $workoutDayRepository;

    public function __construct(WorkoutDayRepository $workoutDayRepo)
    {
        $this->workoutDayRepository = $workoutDayRepo;
    }

    /**
     * Display a listing of the WorkoutDay.
     *
     * @param WorkoutDayDataTable $workoutDayDataTable
     *
     * @return Response
     */
    public function index(WorkoutDayDataTable $workoutDayDataTable)
    {
        return $workoutDayDataTable->render('workout_days.index');
    }

    /**
     * Show the form for creating a new WorkoutDay.
     *
     * @return Response
     */
    public function create()
    {
        return view('workout_days.create');
    }

    /**
     * Store a newly created WorkoutDay in storage.
     *
     * @param CreateWorkoutDayRequest $request
     *
     * @return Response
     */
    public function store(CreateWorkoutDayRequest $request)
    {
        $input = $request->all();

        $workoutDay = $this->workoutDayRepository->create($input);

        Flash::success('Workout Day saved successfully.');

        return redirect(route('workout_days.index'));
    }

    /**
     * Display the specified WorkoutDay.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $workoutDay = $this->workoutDayRepository->find($id);

        if (empty($workoutDay)) {
            Flash::error('Workout Day not found');

            return redirect(route('workout_days.index'));
        }

        return view('workout_days.show')->with('workoutDay', $workoutDay);
    }

    /**
     * Show the form for editing the specified WorkoutDay.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $workoutDay = $this->workoutDayRepository->find($id);

        if (empty($workoutDay)) {
            Flash::error('Workout Day not found');

            return redirect(route('workout_days.index'));
        }

        return view('workout_days.edit')->with('workoutDay', $workoutDay);
    }

    /**
     * Update the specified WorkoutDay in storage.
     *
     * @param int $id
     * @param UpdateWorkoutDayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorkoutDayRequest $request)
    {
        $workoutDay = $this->workoutDayRepository->find($id);

        if (empty($workoutDay)) {
            Flash::error('Workout Day not found');

            return redirect(route('workout_days.index'));
        }

        $workoutDay = $this->workoutDayRepository->update($request->all(), $id);

        Flash::success('Workout Day updated successfully.');

        return redirect(route('workout_days.index'));
    }

    /**
     * Remove the specified WorkoutDay from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $workoutDay = $this->workoutDayRepository->find($id);

        if (empty($workoutDay)) {
            Flash::error('Workout Day not found');

            return redirect(route('workout_days.index'));
        }

        $this->workoutDayRepository->delete($id);

        Flash::success('Workout Day deleted successfully.');

        return redirect(route('workout_days.index'));
    }
}
