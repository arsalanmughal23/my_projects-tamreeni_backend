<?php namespace Tests\Repositories;

use App\Models\Exercise;
use App\Repositories\ExerciseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ExerciseRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExerciseRepository
     */
    protected $exerciseRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->exerciseRepo = \App::make(ExerciseRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_exercise()
    {
        $exercise = Exercise::factory()->make()->toArray();

        $createdExercise = $this->exerciseRepo->create($exercise);

        $createdExercise = $createdExercise->toArray();
        $this->assertArrayHasKey('id', $createdExercise);
        $this->assertNotNull($createdExercise['id'], 'Created Exercise must have id specified');
        $this->assertNotNull(Exercise::find($createdExercise['id']), 'Exercise with given id must be in DB');
        $this->assertModelData($exercise, $createdExercise);
    }

    /**
     * @test read
     */
    public function test_read_exercise()
    {
        $exercise = Exercise::factory()->create();

        $dbExercise = $this->exerciseRepo->find($exercise->id);

        $dbExercise = $dbExercise->toArray();
        $this->assertModelData($exercise->toArray(), $dbExercise);
    }

    /**
     * @test update
     */
    public function test_update_exercise()
    {
        $exercise = Exercise::factory()->create();
        $fakeExercise = Exercise::factory()->make()->toArray();

        $updatedExercise = $this->exerciseRepo->update($fakeExercise, $exercise->id);

        $this->assertModelData($fakeExercise, $updatedExercise->toArray());
        $dbExercise = $this->exerciseRepo->find($exercise->id);
        $this->assertModelData($fakeExercise, $dbExercise->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_exercise()
    {
        $exercise = Exercise::factory()->create();

        $resp = $this->exerciseRepo->delete($exercise->id);

        $this->assertTrue($resp);
        $this->assertNull(Exercise::find($exercise->id), 'Exercise should not exist in DB');
    }
}
