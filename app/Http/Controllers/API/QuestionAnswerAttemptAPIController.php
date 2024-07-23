<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionAnswerAttemptAPIRequest;
use App\Http\Requests\API\UpdateQuestionAnswerAttemptAPIRequest;
use App\Models\QuestionAnswerAttempt;
use App\Repositories\QuestionAnswerAttemptRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuestionAnswerAttemptController
 * @package App\Http\Controllers\API
 */

class QuestionAnswerAttemptAPIController extends AppBaseController
{
    /** @var  QuestionAnswerAttemptRepository */
    private $questionAnswerAttemptRepository;

    public function __construct(QuestionAnswerAttemptRepository $questionAnswerAttemptRepo)
    {
        $this->questionAnswerAttemptRepository = $questionAnswerAttemptRepo;
    }

    /**
     * Display a listing of the QuestionAnswerAttempt.
     * GET|HEAD /question_answer_attempts
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $question_answer_attempts = $this->questionAnswerAttemptRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($question_answer_attempts->toArray(), 'Question Answer Attempts retrieved successfully');
    }

    /**
     * Store a newly created QuestionAnswerAttempt in storage.
     * POST /question_answer_attempts
     *
     * @param CreateQuestionAnswerAttemptAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateQuestionAnswerAttemptAPIRequest $request)
    {
        $input = $request->all();

        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->create($input);

        return $this->sendResponse($questionAnswerAttempt->toArray(), 'Question Answer Attempt saved successfully');
    }

    /**
     * Display the specified QuestionAnswerAttempt.
     * GET|HEAD /question_answer_attempts/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var QuestionAnswerAttempt $questionAnswerAttempt */
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);

        if (empty($questionAnswerAttempt)) {
            return $this->sendError('Question Answer Attempt not found');
        }

        return $this->sendResponse($questionAnswerAttempt->toArray(), 'Question Answer Attempt retrieved successfully');
    }

    /**
     * Update the specified QuestionAnswerAttempt in storage.
     * PUT/PATCH /question_answer_attempts/{id}
     *
     * @param int $id
     * @param UpdateQuestionAnswerAttemptAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateQuestionAnswerAttemptAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionAnswerAttempt $questionAnswerAttempt */
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);

        if (empty($questionAnswerAttempt)) {
            return $this->sendError('Question Answer Attempt not found');
        }

        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->update($input, $id);

        return $this->sendResponse($questionAnswerAttempt->toArray(), 'QuestionAnswerAttempt updated successfully');
    }

    /**
     * Remove the specified QuestionAnswerAttempt from storage.
     * DELETE /question_answer_attempts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var QuestionAnswerAttempt $questionAnswerAttempt */
        $questionAnswerAttempt = $this->questionAnswerAttemptRepository->find($id);

        if (empty($questionAnswerAttempt)) {
            return $this->sendError('Question Answer Attempt not found');
        }

        $questionAnswerAttempt->delete();

        return $this->sendSuccess('Question Answer Attempt deleted successfully');
    }
}
