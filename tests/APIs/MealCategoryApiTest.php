<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MealCategory;

class MealCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_meal_category()
    {
        $mealCategory = MealCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/meal_categories', $mealCategory
        );

        $this->assertApiResponse($mealCategory);
    }

    /**
     * @test
     */
    public function test_read_meal_category()
    {
        $mealCategory = MealCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/meal_categories/'.$mealCategory->id
        );

        $this->assertApiResponse($mealCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_meal_category()
    {
        $mealCategory = MealCategory::factory()->create();
        $editedMealCategory = MealCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/meal_categories/'.$mealCategory->id,
            $editedMealCategory
        );

        $this->assertApiResponse($editedMealCategory);
    }

    /**
     * @test
     */
    public function test_delete_meal_category()
    {
        $mealCategory = MealCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/meal_categories/'.$mealCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/meal_categories/'.$mealCategory->id
        );

        $this->response->assertStatus(404);
    }
}
