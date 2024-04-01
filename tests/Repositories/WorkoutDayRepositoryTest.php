<?php namespace Tests\Repositories;

use App\Models\WorkoutDay;
use App\Repositories\WorkoutDayRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WorkoutDayRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WorkoutDayRepository
     */
    protected $workoutDayRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->workoutDayRepo = \App::make(WorkoutDayRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->make()->toArray();

        $createdWorkoutDay = $this->workoutDayRepo->create($workoutDay);

        $createdWorkoutDay = $createdWorkoutDay->toArray();
        $this->assertArrayHasKey('id', $createdWorkoutDay);
        $this->assertNotNull($createdWorkoutDay['id'], 'Created WorkoutDay must have id specified');
        $this->assertNotNull(WorkoutDay::find($createdWorkoutDay['id']), 'WorkoutDay with given id must be in DB');
        $this->assertModelData($workoutDay, $createdWorkoutDay);
    }

    /**
     * @test read
     */
    public function test_read_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->create();

        $dbWorkoutDay = $this->workoutDayRepo->find($workoutDay->id);

        $dbWorkoutDay = $dbWorkoutDay->toArray();
        $this->assertModelData($workoutDay->toArray(), $dbWorkoutDay);
    }

    /**
     * @test update
     */
    public function test_update_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->create();
        $fakeWorkoutDay = WorkoutDay::factory()->make()->toArray();

        $updatedWorkoutDay = $this->workoutDayRepo->update($fakeWorkoutDay, $workoutDay->id);

        $this->assertModelData($fakeWorkoutDay, $updatedWorkoutDay->toArray());
        $dbWorkoutDay = $this->workoutDayRepo->find($workoutDay->id);
        $this->assertModelData($fakeWorkoutDay, $dbWorkoutDay->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->create();

        $resp = $this->workoutDayRepo->delete($workoutDay->id);

        $this->assertTrue($resp);
        $this->assertNull(WorkoutDay::find($workoutDay->id), 'WorkoutDay should not exist in DB');
    }
}
