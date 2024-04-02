<?php namespace Tests\Repositories;

use App\Models\WorkoutPlan;
use App\Repositories\WorkoutPlanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WorkoutPlanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WorkoutPlanRepository
     */
    protected $workoutPlanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->workoutPlanRepo = \App::make(WorkoutPlanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->make()->toArray();

        $createdWorkoutPlan = $this->workoutPlanRepo->create($workoutPlan);

        $createdWorkoutPlan = $createdWorkoutPlan->toArray();
        $this->assertArrayHasKey('id', $createdWorkoutPlan);
        $this->assertNotNull($createdWorkoutPlan['id'], 'Created WorkoutPlan must have id specified');
        $this->assertNotNull(WorkoutPlan::find($createdWorkoutPlan['id']), 'WorkoutPlan with given id must be in DB');
        $this->assertModelData($workoutPlan, $createdWorkoutPlan);
    }

    /**
     * @test read
     */
    public function test_read_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->create();

        $dbWorkoutPlan = $this->workoutPlanRepo->find($workoutPlan->id);

        $dbWorkoutPlan = $dbWorkoutPlan->toArray();
        $this->assertModelData($workoutPlan->toArray(), $dbWorkoutPlan);
    }

    /**
     * @test update
     */
    public function test_update_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->create();
        $fakeWorkoutPlan = WorkoutPlan::factory()->make()->toArray();

        $updatedWorkoutPlan = $this->workoutPlanRepo->update($fakeWorkoutPlan, $workoutPlan->id);

        $this->assertModelData($fakeWorkoutPlan, $updatedWorkoutPlan->toArray());
        $dbWorkoutPlan = $this->workoutPlanRepo->find($workoutPlan->id);
        $this->assertModelData($fakeWorkoutPlan, $dbWorkoutPlan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->create();

        $resp = $this->workoutPlanRepo->delete($workoutPlan->id);

        $this->assertTrue($resp);
        $this->assertNull(WorkoutPlan::find($workoutPlan->id), 'WorkoutPlan should not exist in DB');
    }
}
