<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NutritionPlan;

class NutritionPlanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nutrition_plans', $nutritionPlan
        );

        $this->assertApiResponse($nutritionPlan);
    }

    /**
     * @test
     */
    public function test_read_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nutrition_plans/'.$nutritionPlan->id
        );

        $this->assertApiResponse($nutritionPlan->toArray());
    }

    /**
     * @test
     */
    public function test_update_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->create();
        $editedNutritionPlan = NutritionPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nutrition_plans/'.$nutritionPlan->id,
            $editedNutritionPlan
        );

        $this->assertApiResponse($editedNutritionPlan);
    }

    /**
     * @test
     */
    public function test_delete_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nutrition_plans/'.$nutritionPlan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nutrition_plans/'.$nutritionPlan->id
        );

        $this->response->assertStatus(404);
    }
}
