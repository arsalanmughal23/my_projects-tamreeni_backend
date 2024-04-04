<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\WorkoutPlan;

class WorkoutPlanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/workout_plans', $workoutPlan
        );

        $this->assertApiResponse($workoutPlan);
    }

    /**
     * @test
     */
    public function test_read_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/workout_plans/'.$workoutPlan->id
        );

        $this->assertApiResponse($workoutPlan->toArray());
    }

    /**
     * @test
     */
    public function test_update_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->create();
        $editedWorkoutPlan = WorkoutPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/workout_plans/'.$workoutPlan->id,
            $editedWorkoutPlan
        );

        $this->assertApiResponse($editedWorkoutPlan);
    }

    /**
     * @test
     */
    public function test_delete_workout_plan()
    {
        $workoutPlan = WorkoutPlan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/workout_plans/'.$workoutPlan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/workout_plans/'.$workoutPlan->id
        );

        $this->response->assertStatus(404);
    }
}
