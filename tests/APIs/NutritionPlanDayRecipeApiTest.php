<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NutritionPlanDayRecipe;

class NutritionPlanDayRecipeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nutrition_plan_day_recipes', $nutritionPlanDayRecipe
        );

        $this->assertApiResponse($nutritionPlanDayRecipe);
    }

    /**
     * @test
     */
    public function test_read_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nutrition_plan_day_recipes/'.$nutritionPlanDayRecipe->id
        );

        $this->assertApiResponse($nutritionPlanDayRecipe->toArray());
    }

    /**
     * @test
     */
    public function test_update_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->create();
        $editedNutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nutrition_plan_day_recipes/'.$nutritionPlanDayRecipe->id,
            $editedNutritionPlanDayRecipe
        );

        $this->assertApiResponse($editedNutritionPlanDayRecipe);
    }

    /**
     * @test
     */
    public function test_delete_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nutrition_plan_day_recipes/'.$nutritionPlanDayRecipe->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nutrition_plan_day_recipes/'.$nutritionPlanDayRecipe->id
        );

        $this->response->assertStatus(404);
    }
}
