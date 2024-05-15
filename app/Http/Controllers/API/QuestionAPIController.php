<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\SubmitAnswersAPIRequest;
use App\Http\Resources\QuestionResource;
use App\Repositories\QuestionRepository;
use App\Repositories\UserDetailRepository;
use Response;

/**
 * Class QuestionController
 * @package App\Http\Controllers\API
 */
class QuestionAPIController extends AppBaseController
{
    public function __construct(
        private QuestionRepository $questionRepository,
        private UserDetailRepository $userDetailRepository
    ){}

    /**
     * Display a listing of the Question.
     * GET|HEAD /question
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $question = $this->questionRepository->index($request);
        return $this->sendResponse(QuestionResource::collection($question), 'Questions retrieved successfully');
    }

    public function submitAnswers(SubmitAnswersAPIRequest $request)
    {
        try {
            /** @var User $user */
            $user = $request->user();
            if (!$userDetails = $user->details)
                throw new \Error('User detail not found');

            $userDetails = $this->userDetailRepository->updateRecord($request->validated(), $user);
            $this->userDetailRepository->updatedStatusPlanIsGenerated($userDetails, 0);

            $responseData = [
                'bmi'    => $userDetails->bmi,
                'bmi_description' => __('messages.bmi_description', ['bmi' => $userDetails->bmi])
            ];

            return $this->sendResponse($responseData, 'Answers are saved successfully');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
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
