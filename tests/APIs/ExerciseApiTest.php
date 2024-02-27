<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Exercise;

class ExerciseApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_exercise()
    {
        $exercise = Exercise::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/exercises', $exercise
        );

        $this->assertApiResponse($exercise);
    }

    /**
     * @test
     */
    public function test_read_exercise()
    {
        $exercise = Exercise::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/exercises/'.$exercise->id
        );

        $this->assertApiResponse($exercise->toArray());
    }

    /**
     * @test
     */
    public function test_update_exercise()
    {
        $exercise = Exercise::factory()->create();
        $editedExercise = Exercise::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/exercises/'.$exercise->id,
            $editedExercise
        );

        $this->assertApiResponse($editedExercise);
    }

    /**
     * @test
     */
    public function test_delete_exercise()
    {
        $exercise = Exercise::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/exercises/'.$exercise->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/exercises/'.$exercise->id
        );

        $this->response->assertStatus(404);
    }
}
