<?php namespace Tests\Repositories;

use App\Models\QuestionAnswerAttempt;
use App\Repositories\QuestionAnswerAttemptRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuestionAnswerAttemptRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuestionAnswerAttemptRepository
     */
    protected $questionAnswerAttemptRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionAnswerAttemptRepo = \App::make(QuestionAnswerAttemptRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->make()->toArray();

        $createdQuestionAnswerAttempt = $this->questionAnswerAttemptRepo->create($questionAnswerAttempt);

        $createdQuestionAnswerAttempt = $createdQuestionAnswerAttempt->toArray();
        $this->assertArrayHasKey('id', $createdQuestionAnswerAttempt);
        $this->assertNotNull($createdQuestionAnswerAttempt['id'], 'Created QuestionAnswerAttempt must have id specified');
        $this->assertNotNull(QuestionAnswerAttempt::find($createdQuestionAnswerAttempt['id']), 'QuestionAnswerAttempt with given id must be in DB');
        $this->assertModelData($questionAnswerAttempt, $createdQuestionAnswerAttempt);
    }

    /**
     * @test read
     */
    public function test_read_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->create();

        $dbQuestionAnswerAttempt = $this->questionAnswerAttemptRepo->find($questionAnswerAttempt->id);

        $dbQuestionAnswerAttempt = $dbQuestionAnswerAttempt->toArray();
        $this->assertModelData($questionAnswerAttempt->toArray(), $dbQuestionAnswerAttempt);
    }

    /**
     * @test update
     */
    public function test_update_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->create();
        $fakeQuestionAnswerAttempt = QuestionAnswerAttempt::factory()->make()->toArray();

        $updatedQuestionAnswerAttempt = $this->questionAnswerAttemptRepo->update($fakeQuestionAnswerAttempt, $questionAnswerAttempt->id);

        $this->assertModelData($fakeQuestionAnswerAttempt, $updatedQuestionAnswerAttempt->toArray());
        $dbQuestionAnswerAttempt = $this->questionAnswerAttemptRepo->find($questionAnswerAttempt->id);
        $this->assertModelData($fakeQuestionAnswerAttempt, $dbQuestionAnswerAttempt->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_question_answer_attempt()
    {
        $questionAnswerAttempt = QuestionAnswerAttempt::factory()->create();

        $resp = $this->questionAnswerAttemptRepo->delete($questionAnswerAttempt->id);

        $this->assertTrue($resp);
        $this->assertNull(QuestionAnswerAttempt::find($questionAnswerAttempt->id), 'QuestionAnswerAttempt should not exist in DB');
    }
}
