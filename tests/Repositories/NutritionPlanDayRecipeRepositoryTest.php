<?php namespace Tests\Repositories;

use App\Models\NutritionPlanDayRecipe;
use App\Repositories\NutritionPlanDayRecipeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NutritionPlanDayRecipeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NutritionPlanDayRecipeRepository
     */
    protected $nutritionPlanDayRecipeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->nutritionPlanDayRecipeRepo = \App::make(NutritionPlanDayRecipeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->make()->toArray();

        $createdNutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepo->create($nutritionPlanDayRecipe);

        $createdNutritionPlanDayRecipe = $createdNutritionPlanDayRecipe->toArray();
        $this->assertArrayHasKey('id', $createdNutritionPlanDayRecipe);
        $this->assertNotNull($createdNutritionPlanDayRecipe['id'], 'Created NutritionPlanDayRecipe must have id specified');
        $this->assertNotNull(NutritionPlanDayRecipe::find($createdNutritionPlanDayRecipe['id']), 'NutritionPlanDayRecipe with given id must be in DB');
        $this->assertModelData($nutritionPlanDayRecipe, $createdNutritionPlanDayRecipe);
    }

    /**
     * @test read
     */
    public function test_read_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->create();

        $dbNutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepo->find($nutritionPlanDayRecipe->id);

        $dbNutritionPlanDayRecipe = $dbNutritionPlanDayRecipe->toArray();
        $this->assertModelData($nutritionPlanDayRecipe->toArray(), $dbNutritionPlanDayRecipe);
    }

    /**
     * @test update
     */
    public function test_update_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->create();
        $fakeNutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->make()->toArray();

        $updatedNutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepo->update($fakeNutritionPlanDayRecipe, $nutritionPlanDayRecipe->id);

        $this->assertModelData($fakeNutritionPlanDayRecipe, $updatedNutritionPlanDayRecipe->toArray());
        $dbNutritionPlanDayRecipe = $this->nutritionPlanDayRecipeRepo->find($nutritionPlanDayRecipe->id);
        $this->assertModelData($fakeNutritionPlanDayRecipe, $dbNutritionPlanDayRecipe->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_nutrition_plan_day_recipe()
    {
        $nutritionPlanDayRecipe = NutritionPlanDayRecipe::factory()->create();

        $resp = $this->nutritionPlanDayRecipeRepo->delete($nutritionPlanDayRecipe->id);

        $this->assertTrue($resp);
        $this->assertNull(NutritionPlanDayRecipe::find($nutritionPlanDayRecipe->id), 'NutritionPlanDayRecipe should not exist in DB');
    }
}
