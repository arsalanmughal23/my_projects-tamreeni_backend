<?php

namespace App\Http\Controllers;

use App\DataTables\ExerciseBreakdownDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExerciseBreakdownRequest;
use App\Http\Requests\UpdateExerciseBreakdownRequest;
use App\Repositories\ExerciseBreakdownRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExerciseBreakdownController extends AppBaseController
{
    /** @var ExerciseBreakdownRepository $exerciseBreakdownRepository*/
    private $exerciseBreakdownRepository;

    public function __construct(ExerciseBreakdownRepository $exerciseBreakdownRepo)
    {
        $this->exerciseBreakdownRepository = $exerciseBreakdownRepo;
    }

    /**
     * Display a listing of the ExerciseBreakdown.
     *
     * @param ExerciseBreakdownDataTable $exerciseBreakdownDataTable
     *
     * @return Response
     */
    public function index(ExerciseBreakdownDataTable $exerciseBreakdownDataTable)
    {
        return $exerciseBreakdownDataTable->render('exercise_breakdowns.index');
    }

    /**
     * Show the form for creating a new ExerciseBreakdown.
     *
     * @return Response
     */
    public function create()
    {
        return view('exercise_breakdowns.create');
    }

    /**
     * Store a newly created ExerciseBreakdown in storage.
     *
     * @param CreateExerciseBreakdownRequest $request
     *
     * @return Response
     */
    public function store(CreateExerciseBreakdownRequest $request)
    {
        $input = $request->all();

        $exerciseBreakdown = $this->exerciseBreakdownRepository->create($input);

        Flash::success('Exercise Breakdown saved successfully.');

        return redirect(route('exercise_breakdowns.index'));
    }

    /**
     * Display the specified ExerciseBreakdown.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exerciseBreakdown = $this->exerciseBreakdownRepository->find($id);

        if (empty($exerciseBreakdown)) {
            Flash::error('Exercise Breakdown not found');

            return redirect(route('exercise_breakdowns.index'));
        }

        return view('exercise_breakdowns.show')->with('exerciseBreakdown', $exerciseBreakdown);
    }

    /**
     * Show the form for editing the specified ExerciseBreakdown.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exerciseBreakdown = $this->exerciseBreakdownRepository->find($id);

        if (empty($exerciseBreakdown)) {
            Flash::error('Exercise Breakdown not found');

            return redirect(route('exercise_breakdowns.index'));
        }

        return view('exercise_breakdowns.edit')->with('exerciseBreakdown', $exerciseBreakdown);
    }

    /**
     * Update the specified ExerciseBreakdown in storage.
     *
     * @param int $id
     * @param UpdateExerciseBreakdownRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExerciseBreakdownRequest $request)
    {
        $exerciseBreakdown = $this->exerciseBreakdownRepository->find($id);

        if (empty($exerciseBreakdown)) {
            Flash::error('Exercise Breakdown not found');

            return redirect(route('exercise_breakdowns.index'));
        }

        $exerciseBreakdown = $this->exerciseBreakdownRepository->update($request->all(), $id);

        Flash::success('Exercise Breakdown updated successfully.');

        return redirect(route('exercise_breakdowns.index'));
    }

    /**
     * Remove the specified ExerciseBreakdown from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exerciseBreakdown = $this->exerciseBreakdownRepository->find($id);

        if (empty($exerciseBreakdown)) {
            Flash::error('Exercise Breakdown not found');

            return redirect(route('exercise_breakdowns.index'));
        }

        $this->exerciseBreakdownRepository->delete($id);

        Flash::success('Exercise Breakdown deleted successfully.');

        return redirect(route('exercise_breakdowns.index'));
    }
}
