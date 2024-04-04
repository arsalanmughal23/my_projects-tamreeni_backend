<?php namespace Tests\Repositories;

use App\Models\NutritionPlan;
use App\Repositories\NutritionPlanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NutritionPlanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NutritionPlanRepository
     */
    protected $nutritionPlanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->nutritionPlanRepo = \App::make(NutritionPlanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->make()->toArray();

        $createdNutritionPlan = $this->nutritionPlanRepo->create($nutritionPlan);

        $createdNutritionPlan = $createdNutritionPlan->toArray();
        $this->assertArrayHasKey('id', $createdNutritionPlan);
        $this->assertNotNull($createdNutritionPlan['id'], 'Created NutritionPlan must have id specified');
        $this->assertNotNull(NutritionPlan::find($createdNutritionPlan['id']), 'NutritionPlan with given id must be in DB');
        $this->assertModelData($nutritionPlan, $createdNutritionPlan);
    }

    /**
     * @test read
     */
    public function test_read_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->create();

        $dbNutritionPlan = $this->nutritionPlanRepo->find($nutritionPlan->id);

        $dbNutritionPlan = $dbNutritionPlan->toArray();
        $this->assertModelData($nutritionPlan->toArray(), $dbNutritionPlan);
    }

    /**
     * @test update
     */
    public function test_update_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->create();
        $fakeNutritionPlan = NutritionPlan::factory()->make()->toArray();

        $updatedNutritionPlan = $this->nutritionPlanRepo->update($fakeNutritionPlan, $nutritionPlan->id);

        $this->assertModelData($fakeNutritionPlan, $updatedNutritionPlan->toArray());
        $dbNutritionPlan = $this->nutritionPlanRepo->find($nutritionPlan->id);
        $this->assertModelData($fakeNutritionPlan, $dbNutritionPlan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_nutrition_plan()
    {
        $nutritionPlan = NutritionPlan::factory()->create();

        $resp = $this->nutritionPlanRepo->delete($nutritionPlan->id);

        $this->assertTrue($resp);
        $this->assertNull(NutritionPlan::find($nutritionPlan->id), 'NutritionPlan should not exist in DB');
    }
}
