<?php namespace Tests\Repositories;

use App\Models\MealBreakdown;
use App\Repositories\MealBreakdownRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MealBreakdownRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MealBreakdownRepository
     */
    protected $mealBreakdownRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mealBreakdownRepo = \App::make(MealBreakdownRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->make()->toArray();

        $createdMealBreakdown = $this->mealBreakdownRepo->create($mealBreakdown);

        $createdMealBreakdown = $createdMealBreakdown->toArray();
        $this->assertArrayHasKey('id', $createdMealBreakdown);
        $this->assertNotNull($createdMealBreakdown['id'], 'Created MealBreakdown must have id specified');
        $this->assertNotNull(MealBreakdown::find($createdMealBreakdown['id']), 'MealBreakdown with given id must be in DB');
        $this->assertModelData($mealBreakdown, $createdMealBreakdown);
    }

    /**
     * @test read
     */
    public function test_read_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->create();

        $dbMealBreakdown = $this->mealBreakdownRepo->find($mealBreakdown->id);

        $dbMealBreakdown = $dbMealBreakdown->toArray();
        $this->assertModelData($mealBreakdown->toArray(), $dbMealBreakdown);
    }

    /**
     * @test update
     */
    public function test_update_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->create();
        $fakeMealBreakdown = MealBreakdown::factory()->make()->toArray();

        $updatedMealBreakdown = $this->mealBreakdownRepo->update($fakeMealBreakdown, $mealBreakdown->id);

        $this->assertModelData($fakeMealBreakdown, $updatedMealBreakdown->toArray());
        $dbMealBreakdown = $this->mealBreakdownRepo->find($mealBreakdown->id);
        $this->assertModelData($fakeMealBreakdown, $dbMealBreakdown->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_meal_breakdown()
    {
        $mealBreakdown = MealBreakdown::factory()->create();

        $resp = $this->mealBreakdownRepo->delete($mealBreakdown->id);

        $this->assertTrue($resp);
        $this->assertNull(MealBreakdown::find($mealBreakdown->id), 'MealBreakdown should not exist in DB');
    }
}
