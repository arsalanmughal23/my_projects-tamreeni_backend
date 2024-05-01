<?php

namespace App\Http\Controllers;

use App\DataTables\OptionDataTable;
use App\DataTables\QuestionDataTable;
use App\Helper\FileHelper;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Repositories\QuestionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionController extends AppBaseController
{
    /** @var QuestionRepository $questionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     *
     * @param QuestionDataTable $questionDataTable
     *
     * @return Response
     */
    public function index(QuestionDataTable $questionDataTable)
    {
        return $questionDataTable->render('questions.index');
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('cover_image')) {
            $input['cover_image'] = FileHelper::s3Upload($input['cover_image']);
        }

        $question = $this->questionRepository->create($input);

        Flash::success('Question saved successfully.');

        return redirect(route('questions.index'));
    }

    /**
     * Display the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, OptionDataTable $optionDataTable)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

//        return view('questions.show')->with('question', $question);

        $optionDataTable->question_id = $id;
        return $optionDataTable->render('questions.show', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        return view('questions.edit')->with('question', $question);
    }

    /**
     * Update the specified Question in storage.
     *
     * @param int $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRequest $request)
    {
        $question = $this->questionRepository->find($id);
        $input    = $request->all();
        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        if ($request->hasFile('cover_image')) {
            $input['cover_image'] = FileHelper::s3Upload($input['cover_image']);
        }

        $question = $this->questionRepository->update($input, $id);

        Flash::success('Question updated successfully.');

        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        $this->questionRepository->delete($id);

        Flash::success('Question deleted successfully.');

        return redirect(route('questions.index'));
    }
}
