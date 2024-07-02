<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\QuestionAnswerAttempt;

class QuestionAnswerAttemptApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/question_answer_attempts', $questionAnswerAttempt
        );

        $this->assertApiResponse($questionAnswerAttempt);
    }

    /**
     * @test
     */
    public function test_read_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/question_answer_attempts/'.$questionAnswerAttempt->id
        );

        $this->assertApiResponse($questionAnswerAttempt->toArray());
    }

    /**
     * @test
     */
    public function test_update_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->create();
        $editedQuestionAnswerAttempt = QuestionAnswerAttempt::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/question_answer_attempts/'.$questionAnswerAttempt->id,
            $editedQuestionAnswerAttempt
        );

        $this->assertApiResponse($editedQuestionAnswerAttempt);
    }

    /**
     * @test
     */
    public function test_delete_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/question_answer_attempts/'.$questionAnswerAttempt->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/question_answer_attempts/'.$questionAnswerAttempt->id
        );

        $this->response->assertStatus(404);
    }
}
