<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ExerciseEquipment;

class ExerciseEquipmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/exercise_equipments', $exerciseEquipment
        );

        $this->assertApiResponse($exerciseEquipment);
    }

    /**
     * @test
     */
    public function test_read_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/exercise_equipments/'.$exerciseEquipment->id
        );

        $this->assertApiResponse($exerciseEquipment->toArray());
    }

    /**
     * @test
     */
    public function test_update_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->create();
        $editedExerciseEquipment = ExerciseEquipment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/exercise_equipments/'.$exerciseEquipment->id,
            $editedExerciseEquipment
        );

        $this->assertApiResponse($editedExerciseEquipment);
    }

    /**
     * @test
     */
    public function test_delete_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/exercise_equipments/'.$exerciseEquipment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/exercise_equipments/'.$exerciseEquipment->id
        );

        $this->response->assertStatus(404);
    }
}
