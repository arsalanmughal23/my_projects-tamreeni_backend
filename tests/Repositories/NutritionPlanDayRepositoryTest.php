<?php namespace Tests\Repositories;

use App\Models\NutritionPlanDay;
use App\Repositories\NutritionPlanDayRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NutritionPlanDayRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NutritionPlanDayRepository
     */
    protected $nutritionPlanDayRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->nutritionPlanDayRepo = \App::make(NutritionPlanDayRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->make()->toArray();

        $createdNutritionPlanDay = $this->nutritionPlanDayRepo->create($nutritionPlanDay);

        $createdNutritionPlanDay = $createdNutritionPlanDay->toArray();
        $this->assertArrayHasKey('id', $createdNutritionPlanDay);
        $this->assertNotNull($createdNutritionPlanDay['id'], 'Created NutritionPlanDay must have id specified');
        $this->assertNotNull(NutritionPlanDay::find($createdNutritionPlanDay['id']), 'NutritionPlanDay with given id must be in DB');
        $this->assertModelData($nutritionPlanDay, $createdNutritionPlanDay);
    }

    /**
     * @test read
     */
    public function test_read_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->create();

        $dbNutritionPlanDay = $this->nutritionPlanDayRepo->find($nutritionPlanDay->id);

        $dbNutritionPlanDay = $dbNutritionPlanDay->toArray();
        $this->assertModelData($nutritionPlanDay->toArray(), $dbNutritionPlanDay);
    }

    /**
     * @test update
     */
    public function test_update_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->create();
        $fakeNutritionPlanDay = NutritionPlanDay::factory()->make()->toArray();

        $updatedNutritionPlanDay = $this->nutritionPlanDayRepo->update($fakeNutritionPlanDay, $nutritionPlanDay->id);

        $this->assertModelData($fakeNutritionPlanDay, $updatedNutritionPlanDay->toArray());
        $dbNutritionPlanDay = $this->nutritionPlanDayRepo->find($nutritionPlanDay->id);
        $this->assertModelData($fakeNutritionPlanDay, $dbNutritionPlanDay->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_nutrition_plan_day()
    {
        $nutritionPlanDay = NutritionPlanDay::factory()->create();

        $resp = $this->nutritionPlanDayRepo->delete($nutritionPlanDay->id);

        $this->assertTrue($resp);
        $this->assertNull(NutritionPlanDay::find($nutritionPlanDay->id), 'NutritionPlanDay should not exist in DB');
    }
}
