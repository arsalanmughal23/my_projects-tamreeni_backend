<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\WorkoutDay;

class WorkoutDayApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/workout_days', $workoutDay
        );

        $this->assertApiResponse($workoutDay);
    }

    /**
     * @test
     */
    public function test_read_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/workout_days/'.$workoutDay->id
        );

        $this->assertApiResponse($workoutDay->toArray());
    }

    /**
     * @test
     */
    public function test_update_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->create();
        $editedWorkoutDay = WorkoutDay::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/workout_days/'.$workoutDay->id,
            $editedWorkoutDay
        );

        $this->assertApiResponse($editedWorkoutDay);
    }

    /**
     * @test
     */
    public function test_delete_workout_day()
    {
        $workoutDay = WorkoutDay::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/workout_days/'.$workoutDay->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/workout_days/'.$workoutDay->id
        );

        $this->response->assertStatus(404);
    }
}
