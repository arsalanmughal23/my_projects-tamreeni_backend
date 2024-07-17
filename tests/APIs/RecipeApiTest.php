<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Recipe;

class RecipeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_recipe()
    {
        $recipe = Recipe::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/recipes', $recipe
        );

        $this->assertApiResponse($recipe);
    }

    /**
     * @test
     */
    public function test_read_recipe()
    {
        $recipe = Recipe::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/recipes/'.$recipe->id
        );

        $this->assertApiResponse($recipe->toArray());
    }

    /**
     * @test
     */
    public function test_update_recipe()
    {
        $recipe = Recipe::factory()->create();
        $editedRecipe = Recipe::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/recipes/'.$recipe->id,
            $editedRecipe
        );

        $this->assertApiResponse($editedRecipe);
    }

    /**
     * @test
     */
    public function test_delete_recipe()
    {
        $recipe = Recipe::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/recipes/'.$recipe->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/recipes/'.$recipe->id
        );

        $this->response->assertStatus(404);
    }
}
