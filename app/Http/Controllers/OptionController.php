<?php

namespace App\Http\Controllers;

use App\DataTables\OptionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Question;
use App\Repositories\OptionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OptionController extends AppBaseController
{
    /** @var OptionRepository $optionRepository */
    private $optionRepository;

    public function __construct(OptionRepository $optionRepo)
    {
        $this->optionRepository = $optionRepo;
    }

    /**
     * Display a listing of the Option.
     *
     * @param OptionDataTable $optionDataTable
     *
     * @return Response
     */
    public function index(OptionDataTable $optionDataTable)
    {
        return $optionDataTable->render('options.index');
    }

    /**
     * Show the form for creating a new Option.
     *
     * @return Response
     */
    public function create()
    {
        $questions = Question::all();

        return view('options.create')->with('questions', $questions);
    }

    /**
     * Store a newly created Option in storage.
     *
     * @param CreateOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateOptionRequest $request)
    {
        $input = $request->all();

        $option = $this->optionRepository->create($input);

        Flash::success('Option saved successfully.');

        return redirect(route('options.index'));
    }

    /**
     * Display the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error('Option not found');

            return redirect(route('options.index'));
        }

        return view('options.show')->with('option', $option);
    }

    /**
     * Show the form for editing the specified Option.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $option    = $this->optionRepository->find($id);
        $questions = Question::all();

        if (empty($option)) {
            Flash::error('Option not found');

            return redirect(route('options.index'));
        }

        return view('options.edit')->with(['questions' => $questions, 'option' => $option]);
    }

    /**
     * Update the specified Option in storage.
     *
     * @param int $id
     * @param UpdateOptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOptionRequest $request)
    {
//        dd($request->all());
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error('Option not found');

            return redirect(route('options.index'));
        }

        $option = $this->optionRepository->updateRecord($request, $id);

        Flash::success('Option updated successfully.');

        return redirect(route('questions.show', $request->question_id));
    }

    /**
     * Remove the specified Option from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $option = $this->optionRepository->find($id);

        if (empty($option)) {
            Flash::error('Option not found');

            return redirect(route('options.index'));
        }

        $this->optionRepository->delete($id);

        Flash::success('Option deleted successfully.');

        return redirect(route('questions.index'));
    }
}
