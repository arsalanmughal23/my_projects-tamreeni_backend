<?php namespace Tests\Repositories;

use App\Models\RecipeIngredient;
use App\Repositories\RecipeIngredientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RecipeIngredientRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RecipeIngredientRepository
     */
    protected $recipeIngredientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->recipeIngredientRepo = \App::make(RecipeIngredientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->make()->toArray();

        $createdRecipeIngredient = $this->recipeIngredientRepo->create($recipeIngredient);

        $createdRecipeIngredient = $createdRecipeIngredient->toArray();
        $this->assertArrayHasKey('id', $createdRecipeIngredient);
        $this->assertNotNull($createdRecipeIngredient['id'], 'Created RecipeIngredient must have id specified');
        $this->assertNotNull(RecipeIngredient::find($createdRecipeIngredient['id']), 'RecipeIngredient with given id must be in DB');
        $this->assertModelData($recipeIngredient, $createdRecipeIngredient);
    }

    /**
     * @test read
     */
    public function test_read_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->create();

        $dbRecipeIngredient = $this->recipeIngredientRepo->find($recipeIngredient->id);

        $dbRecipeIngredient = $dbRecipeIngredient->toArray();
        $this->assertModelData($recipeIngredient->toArray(), $dbRecipeIngredient);
    }

    /**
     * @test update
     */
    public function test_update_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->create();
        $fakeRecipeIngredient = RecipeIngredient::factory()->make()->toArray();

        $updatedRecipeIngredient = $this->recipeIngredientRepo->update($fakeRecipeIngredient, $recipeIngredient->id);

        $this->assertModelData($fakeRecipeIngredient, $updatedRecipeIngredient->toArray());
        $dbRecipeIngredient = $this->recipeIngredientRepo->find($recipeIngredient->id);
        $this->assertModelData($fakeRecipeIngredient, $dbRecipeIngredient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_recipe_ingredient()
    {
        $recipeIngredient = RecipeIngredient::factory()->create();

        $resp = $this->recipeIngredientRepo->delete($recipeIngredient->id);

        $this->assertTrue($resp);
        $this->assertNull(RecipeIngredient::find($recipeIngredient->id), 'RecipeIngredient should not exist in DB');
    }
}
