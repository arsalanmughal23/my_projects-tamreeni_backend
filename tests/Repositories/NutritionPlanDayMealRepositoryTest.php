<?php namespace Tests\Repositories;

use App\Models\NutritionPlanDayMeal;
use App\Repositories\NutritionPlanDayMealRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NutritionPlanDayMealRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NutritionPlanDayMealRepository
     */
    protected $nutritionPlanDayMealRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->nutritionPlanDayMealRepo = \App::make(NutritionPlanDayMealRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->make()->toArray();

        $createdNutritionPlanDayMeal = $this->nutritionPlanDayMealRepo->create($nutritionPlanDayMeal);

        $createdNutritionPlanDayMeal = $createdNutritionPlanDayMeal->toArray();
        $this->assertArrayHasKey('id', $createdNutritionPlanDayMeal);
        $this->assertNotNull($createdNutritionPlanDayMeal['id'], 'Created NutritionPlanDayMeal must have id specified');
        $this->assertNotNull(NutritionPlanDayMeal::find($createdNutritionPlanDayMeal['id']), 'NutritionPlanDayMeal with given id must be in DB');
        $this->assertModelData($nutritionPlanDayMeal, $createdNutritionPlanDayMeal);
    }

    /**
     * @test read
     */
    public function test_read_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->create();

        $dbNutritionPlanDayMeal = $this->nutritionPlanDayMealRepo->find($nutritionPlanDayMeal->id);

        $dbNutritionPlanDayMeal = $dbNutritionPlanDayMeal->toArray();
        $this->assertModelData($nutritionPlanDayMeal->toArray(), $dbNutritionPlanDayMeal);
    }

    /**
     * @test update
     */
    public function test_update_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->create();
        $fakeNutritionPlanDayMeal = NutritionPlanDayMeal::factory()->make()->toArray();

        $updatedNutritionPlanDayMeal = $this->nutritionPlanDayMealRepo->update($fakeNutritionPlanDayMeal, $nutritionPlanDayMeal->id);

        $this->assertModelData($fakeNutritionPlanDayMeal, $updatedNutritionPlanDayMeal->toArray());
        $dbNutritionPlanDayMeal = $this->nutritionPlanDayMealRepo->find($nutritionPlanDayMeal->id);
        $this->assertModelData($fakeNutritionPlanDayMeal, $dbNutritionPlanDayMeal->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_nutrition_plan_day_meal()
    {
        $nutritionPlanDayMeal = NutritionPlanDayMeal::factory()->create();

        $resp = $this->nutritionPlanDayMealRepo->delete($nutritionPlanDayMeal->id);

        $this->assertTrue($resp);
        $this->assertNull(NutritionPlanDayMeal::find($nutritionPlanDayMeal->id), 'NutritionPlanDayMeal should not exist in DB');
    }
}
