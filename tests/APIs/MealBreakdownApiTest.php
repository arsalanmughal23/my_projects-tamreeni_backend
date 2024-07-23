<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MealBreakdown;

class MealBreakdownApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/meal_breakdowns', $mealBreakdown
        );

        $this->assertApiResponse($mealBreakdown);
    }

    /**
     * @test
     */
    public function test_read_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/meal_breakdowns/'.$mealBreakdown->id
        );

        $this->assertApiResponse($mealBreakdown->toArray());
    }

    /**
     * @test
     */
    public function test_update_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->create();
        $editedMealBreakdown = MealBreakdown::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/meal_breakdowns/'.$mealBreakdown->id,
            $editedMealBreakdown
        );

        $this->assertApiResponse($editedMealBreakdown);
    }

    /**
     * @test
     */
    public function test_delete_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/meal_breakdowns/'.$mealBreakdown->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/meal_breakdowns/'.$mealBreakdown->id
        );

        $this->response->assertStatus(404);
    }
}
