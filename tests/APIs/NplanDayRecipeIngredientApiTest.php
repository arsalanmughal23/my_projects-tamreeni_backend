<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NplanDayRecipeIngredient;

class NplanDayRecipeIngredientApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nplan_day_recipe_ingredients', $nplanDayRecipeIngredient
        );

        $this->assertApiResponse($nplanDayRecipeIngredient);
    }

    /**
     * @test
     */
    public function test_read_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nplan_day_recipe_ingredients/'.$nplanDayRecipeIngredient->id
        );

        $this->assertApiResponse($nplanDayRecipeIngredient->toArray());
    }

    /**
     * @test
     */
    public function test_update_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->create();
        $editedNplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nplan_day_recipe_ingredients/'.$nplanDayRecipeIngredient->id,
            $editedNplanDayRecipeIngredient
        );

        $this->assertApiResponse($editedNplanDayRecipeIngredient);
    }

    /**
     * @test
     */
    public function test_delete_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nplan_day_recipe_ingredients/'.$nplanDayRecipeIngredient->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nplan_day_recipe_ingredients/'.$nplanDayRecipeIngredient->id
        );

        $this->response->assertStatus(404);
    }
}
