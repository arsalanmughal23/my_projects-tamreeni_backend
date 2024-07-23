<?php namespace Tests\Repositories;

use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RecipeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RecipeRepository
     */
    protected $recipeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->recipeRepo = \App::make(RecipeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_recipe()
    {
        $recipe = Recipe::factory()->make()->toArray();

        $createdRecipe = $this->recipeRepo->create($recipe);

        $createdRecipe = $createdRecipe->toArray();
        $this->assertArrayHasKey('id', $createdRecipe);
        $this->assertNotNull($createdRecipe['id'], 'Created Recipe must have id specified');
        $this->assertNotNull(Recipe::find($createdRecipe['id']), 'Recipe with given id must be in DB');
        $this->assertModelData($recipe, $createdRecipe);
    }

    /**
     * @test read
     */
    public function test_read_recipe()
    {
        $recipe = Recipe::factory()->create();

        $dbRecipe = $this->recipeRepo->find($recipe->id);

        $dbRecipe = $dbRecipe->toArray();
        $this->assertModelData($recipe->toArray(), $dbRecipe);
    }

    /**
     * @test update
     */
    public function test_update_recipe()
    {
        $recipe = Recipe::factory()->create();
        $fakeRecipe = Recipe::factory()->make()->toArray();

        $updatedRecipe = $this->recipeRepo->update($fakeRecipe, $recipe->id);

        $this->assertModelData($fakeRecipe, $updatedRecipe->toArray());
        $dbRecipe = $this->recipeRepo->find($recipe->id);
        $this->assertModelData($fakeRecipe, $dbRecipe->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_recipe()
    {
        $recipe = Recipe::factory()->create();

        $resp = $this->recipeRepo->delete($recipe->id);

        $this->assertTrue($resp);
        $this->assertNull(Recipe::find($recipe->id), 'Recipe should not exist in DB');
    }
}
