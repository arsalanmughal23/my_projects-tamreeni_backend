<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NutritionPlanDay;

class NutritionPlanDayApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nutrition_plan_days', $nutritionPlanDay
        );

        $this->assertApiResponse($nutritionPlanDay);
    }

    /**
     * @test
     */
    public function test_read_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nutrition_plan_days/'.$nutritionPlanDay->id
        );

        $this->assertApiResponse($nutritionPlanDay->toArray());
    }

    /**
     * @test
     */
    public function test_update_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->create();
        $editedNutritionPlanDay = NutritionPlanDay::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nutrition_plan_days/'.$nutritionPlanDay->id,
            $editedNutritionPlanDay
        );

        $this->assertApiResponse($editedNutritionPlanDay);
    }

    /**
     * @test
     */
    public function test_delete_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nutrition_plan_days/'.$nutritionPlanDay->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nutrition_plan_days/'.$nutritionPlanDay->id
        );

        $this->response->assertStatus(404);
    }
}
