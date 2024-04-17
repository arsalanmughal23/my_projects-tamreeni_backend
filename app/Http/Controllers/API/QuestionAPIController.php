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
        $question = $this->questionRepository->all();

        return $this->sendResponse($question->toArray(), 'Questions retrieved successfully');
    }

    public function submitAnswers(SubmitAnswersAPIRequest $request)
    {
        try {
            /** @var User $user */
            $user = $request->user();
            if (!$userDetails = $user->details)
                throw new Error('User detail not found');

            $calculatedBMI = $request->current_weight_in_kg / pow($request->height_in_m, 2);
            $userDetails->update($request->validated());
            $userDetails->bmi = $calculatedBMI;
            $userDetails->save();

            $responseData = [
                'bmi'    => $calculatedBMI,
                'detail' => 'A BMI of ' . $calculatedBMI . ' falls within the `normal weight` category, which typically ranges between 18.5 to 24.5. It suggests that a person is at a healthy weight in proportion to their height.'
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
