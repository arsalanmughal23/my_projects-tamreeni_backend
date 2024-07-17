<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RecipeIngredient;

class RecipeIngredientApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/recipe_ingredients', $recipeIngredient
        );

        $this->assertApiResponse($recipeIngredient);
    }

    /**
     * @test
     */
    public function test_read_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/recipe_ingredients/'.$recipeIngredient->id
        );

        $this->assertApiResponse($recipeIngredient->toArray());
    }

    /**
     * @test
     */
    public function test_update_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->create();
        $editedRecipeIngredient = RecipeIngredient::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/recipe_ingredients/'.$recipeIngredient->id,
            $editedRecipeIngredient
        );

        $this->assertApiResponse($editedRecipeIngredient);
    }

    /**
     * @test
     */
    public function test_delete_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/recipe_ingredients/'.$recipeIngredient->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/recipe_ingredients/'.$recipeIngredient->id
        );

        $this->response->assertStatus(404);
    }
}
