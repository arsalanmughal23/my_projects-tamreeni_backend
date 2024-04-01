<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\WorkoutDayExercise;

class WorkoutDayExerciseApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/workout_day_exercises', $workoutDayExercise
        );

        $this->assertApiResponse($workoutDayExercise);
    }

    /**
     * @test
     */
    public function test_read_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/workout_day_exercises/'.$workoutDayExercise->id
        );

        $this->assertApiResponse($workoutDayExercise->toArray());
    }

    /**
     * @test
     */
    public function test_update_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->create();
        $editedWorkoutDayExercise = WorkoutDayExercise::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/workout_day_exercises/'.$workoutDayExercise->id,
            $editedWorkoutDayExercise
        );

        $this->assertApiResponse($editedWorkoutDayExercise);
    }

    /**
     * @test
     */
    public function test_delete_workout_day_exercise()
    {
        $workoutDayExercise = WorkoutDayExercise::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/workout_day_exercises/'.$workoutDayExercise->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/workout_day_exercises/'.$workoutDayExercise->id
        );

        $this->response->assertStatus(404);
    }
}
