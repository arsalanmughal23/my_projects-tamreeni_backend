<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\SubmitAnswersAPIRequest;
use App\Http\Resources\QuestionResource;
use App\Models\User;
use App\Models\UserDetail;
use App\Repositories\QuestionAnswerAttemptRepository;
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
        private UserDetailRepository $userDetailRepository,
        private QuestionAnswerAttemptRepository $userAnswerAttempt
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
        $requestData = $request->validated();

        if ($requestData['level'] == 'beginner') {
            unset($requestData['squat__one_rep_max_in_kg']);
            unset($requestData['deadlift__one_rep_max_in_kg']);
            unset($requestData['bench__one_rep_max_in_kg']);
            unset($requestData['overhead__one_rep_max_in_kg']);
        }

        try {
            /** @var User $user */
            $user = $request->user();

            /** @var UserDetail $userDetails */
            if (!$userDetails = $user->details)
                throw new \Error('User detail not found');

            $this->userDetailRepository->clearQuestionnaireUserDetails($userDetails);
            $userDetails = $this->userDetailRepository->updateRecord($requestData, $user);
            $userAnswerAttempt = $this->userAnswerAttempt->createRecord($userDetails);
            $userDetails->unplaned_answer_attempt_id = $userAnswerAttempt->id;
            $userDetails->save();

            $userAnswerAttemptCalculatedBMI = $userAnswerAttempt->bmi;
            $weightCategory = $this->userDetailRepository->getWeightCategory($userAnswerAttemptCalculatedBMI);

            $responseData = [
                'bmi'    => $userAnswerAttemptCalculatedBMI,
                'bmi_description' => __('messages.bmi_description', ['bmi' => $userAnswerAttemptCalculatedBMI, 'weight_category' => $weightCategory]),
                'weight_category' => $weightCategory
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
