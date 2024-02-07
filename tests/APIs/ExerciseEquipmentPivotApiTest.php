<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ExerciseEquipmentPivot;

class ExerciseEquipmentPivotApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/exercise_equipment_pivots', $exerciseEquipmentPivot
        );

        $this->assertApiResponse($exerciseEquipmentPivot);
    }

    /**
     * @test
     */
    public function test_read_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/exercise_equipment_pivots/'.$exerciseEquipmentPivot->id
        );

        $this->assertApiResponse($exerciseEquipmentPivot->toArray());
    }

    /**
     * @test
     */
    public function test_update_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->create();
        $editedExerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/exercise_equipment_pivots/'.$exerciseEquipmentPivot->id,
            $editedExerciseEquipmentPivot
        );

        $this->assertApiResponse($editedExerciseEquipmentPivot);
    }

    /**
     * @test
     */
    public function test_delete_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/exercise_equipment_pivots/'.$exerciseEquipmentPivot->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/exercise_equipment_pivots/'.$exerciseEquipmentPivot->id
        );

        $this->response->assertStatus(404);
    }
}
