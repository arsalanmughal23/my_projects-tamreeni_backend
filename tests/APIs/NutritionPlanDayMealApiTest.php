<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NutritionPlanDayMeal;

class NutritionPlanDayMealApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nutrition_plan_day_meals', $nutritionPlanDayMeal
        );

        $this->assertApiResponse($nutritionPlanDayMeal);
    }

    /**
     * @test
     */
    public function test_read_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nutrition_plan_day_meals/'.$nutritionPlanDayMeal->id
        );

        $this->assertApiResponse($nutritionPlanDayMeal->toArray());
    }

    /**
     * @test
     */
    public function test_update_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->create();
        $editedNutritionPlanDayMeal = NutritionPlanDayMeal::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nutrition_plan_day_meals/'.$nutritionPlanDayMeal->id,
            $editedNutritionPlanDayMeal
        );

        $this->assertApiResponse($editedNutritionPlanDayMeal);
    }

    /**
     * @test
     */
    public function test_delete_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nutrition_plan_day_meals/'.$nutritionPlanDayMeal->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nutrition_plan_day_meals/'.$nutritionPlanDayMeal->id
        );

        $this->response->assertStatus(404);
    }
}
