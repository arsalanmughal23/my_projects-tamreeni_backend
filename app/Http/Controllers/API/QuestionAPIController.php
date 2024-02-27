<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\SubmitAnswersAPIRequest;
use App\Repositories\QuestionRepository;
use Response;

/**
 * Class QuestionController
 * @package App\Http\Controllers\API
 */

class QuestionAPIController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     * GET|HEAD /question
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $question = $this->questionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($question->toArray(), 'Questions retrieved successfully');
    }

    /**
     * Store a newly created Question in storage.
     * POST /question
     *
     * @param Request $request
     *
     * @return Response
     */

    // public function store(Request $request)
    // {
    //     $input = $request->all();

    //     $question = $this->questionRepository->create($input);

    //     return $this->sendResponse($question->toArray(), 'Question saved successfully');
    // }

    /**
     * Display the specified Question.
     * GET|HEAD /question/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        return $this->sendResponse($question->toArray(), 'Question retrieved successfully');
    }

    /**
     * Update the specified Question in storage.
     * PUT/PATCH /question/{id}
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */

    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        $question = $this->questionRepository->update($input, $id);

        return $this->sendResponse($question->toArray(), 'Question updated successfully');
    }

    /**
     * Remove the specified Question from storage.
     * DELETE /question/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        $question->delete();

        return $this->sendSuccess('Question deleted successfully');
    }
}
