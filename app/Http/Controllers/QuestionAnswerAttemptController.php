<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionAnswerAttemptDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionAnswerAttemptRequest;
use App\Http\Requests\UpdateQuestionAnswerAttemptRequest;
use App\Repositories\QuestionAnswerAttemptRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuestionAnswerAttemptController extends AppBaseController
{
    /** @var QuestionAnswerAttemptRepository $questionAnswerAttemptRepository*/
    private $questionAnswerAttemptRepository;

    public function __construct(QuestionAnswerAttemptRepository $questionAnswerAttemptRepo)
    {
        $this->questionAnswerAttemptRepository = $questionAnswerAttemptRepo;
    }

    /**
     * Display a listing of the QuestionAnswerAttempt.
     *
     * @param QuestionAnswerAttemptDataTable $questionAnswerAttemptDataTable
     *
     * @return Response
     */
    public function index(QuestionAnswerAttemptDataTable $questionAnswerAttemptDataTable)
    {
        return $questionAnswerAttemptDataTable->render('question_answer_attempts.index');
    }

    /**
     * Show the form for creating a new QuestionAnswerAttempt.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_answer_attempts.create');
    }

    /**
     * Store a newly created QuestionAnswerAttempt in storage.
     *
     * @param CreateQuestionAnswerAttemptRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionAnswerAttemptRequest $request)
    {
        $input = $request->all();

        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->create($input);

        Flash::success('Question Answer Attempt saved successfully.');

        return redirect(route('question_answer_attempts.index'));
    }

    /**
     * Display the specified QuestionAnswerAttempt.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);
        
        if (empty($questionAnswerAttempt)) {
            Flash::error('Question Answer Attempt not found');
            
            return redirect(route('question_answer_attempts.index'));
        }

        return view('question_answer_attempts.show')->with('questionAnswerAttempt', $questionAnswerAttempt);
    }

    /**
     * Show the form for editing the specified QuestionAnswerAttempt.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);

        if (empty($questionAnswerAttempt)) {
            Flash::error('Question Answer Attempt not found');

            return redirect(route('question_answer_attempts.index'));
        }

        return view('question_answer_attempts.edit')->with('questionAnswerAttempt', $questionAnswerAttempt);
    }

    /**
     * Update the specified QuestionAnswerAttempt in storage.
     *
     * @param int $id
     * @param UpdateQuestionAnswerAttemptRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionAnswerAttemptRequest $request)
    {
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);

        if (empty($questionAnswerAttempt)) {
            Flash::error('Question Answer Attempt not found');

            return redirect(route('question_answer_attempts.index'));
        }

        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->update($request->all(), $id);

        Flash::success('Question Answer Attempt updated successfully.');

        return redirect(route('question_answer_attempts.index'));
    }

    /**
     * Remove the specified QuestionAnswerAttempt from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);

        if (empty($questionAnswerAttempt)) {
            Flash::error('Question Answer Attempt not found');

            return redirect(route('question_answer_attempts.index'));
        }

        $this->questionAnswerAttemptRepository->delete($id);

        Flash::success('Question Answer Attempt deleted successfully.');

        return redirect(route('question_answer_attempts.index'));
    }
}
