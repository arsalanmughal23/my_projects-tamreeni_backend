<?php namespace Tests\Repositories;

use App\Models\WorkoutDayExercise;
use App\Repositories\WorkoutDayExerciseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WorkoutDayExerciseRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WorkoutDayExerciseRepository
     */
    protected $workoutDayExerciseRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->workoutDayExerciseRepo = \App::make(WorkoutDayExerciseRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->make()->toArray();

        $createdWorkoutDayExercise = $this->workoutDayExerciseRepo->create($workoutDayExercise);

        $createdWorkoutDayExercise = $createdWorkoutDayExercise->toArray();
        $this->assertArrayHasKey('id', $createdWorkoutDayExercise);
        $this->assertNotNull($createdWorkoutDayExercise['id'], 'Created WorkoutDayExercise must have id specified');
        $this->assertNotNull(WorkoutDayExercise::find($createdWorkoutDayExercise['id']), 'WorkoutDayExercise with given id must be in DB');
        $this->assertModelData($workoutDayExercise, $createdWorkoutDayExercise);
    }

    /**
     * @test read
     */
    public function test_read_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->create();

        $dbWorkoutDayExercise = $this->workoutDayExerciseRepo->find($workoutDayExercise->id);

        $dbWorkoutDayExercise = $dbWorkoutDayExercise->toArray();
        $this->assertModelData($workoutDayExercise->toArray(), $dbWorkoutDayExercise);
    }

    /**
     * @test update
     */
    public function test_update_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->create();
        $fakeWorkoutDayExercise = WorkoutDayExercise::factory()->make()->toArray();

        $updatedWorkoutDayExercise = $this->workoutDayExerciseRepo->update($fakeWorkoutDayExercise, $workoutDayExercise->id);

        $this->assertModelData($fakeWorkoutDayExercise, $updatedWorkoutDayExercise->toArray());
        $dbWorkoutDayExercise = $this->workoutDayExerciseRepo->find($workoutDayExercise->id);
        $this->assertModelData($fakeWorkoutDayExercise, $dbWorkoutDayExercise->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->create();

        $resp = $this->workoutDayExerciseRepo->delete($workoutDayExercise->id);

        $this->assertTrue($resp);
        $this->assertNull(WorkoutDayExercise::find($workoutDayExercise->id), 'WorkoutDayExercise should not exist in DB');
    }
}
