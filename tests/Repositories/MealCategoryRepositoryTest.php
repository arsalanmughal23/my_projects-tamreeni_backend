<?php namespace Tests\Repositories;

use App\Models\MealCategory;
use App\Repositories\MealCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MealCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MealCategoryRepository
     */
    protected $mealCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mealCategoryRepo = \App::make(MealCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_meal_category()
    {
        $mealCategory = MealCategory::factory()->make()->toArray();

        $createdMealCategory = $this->mealCategoryRepo->create($mealCategory);

        $createdMealCategory = $createdMealCategory->toArray();
        $this->assertArrayHasKey('id', $createdMealCategory);
        $this->assertNotNull($createdMealCategory['id'], 'Created MealCategory must have id specified');
        $this->assertNotNull(MealCategory::find($createdMealCategory['id']), 'MealCategory with given id must be in DB');
        $this->assertModelData($mealCategory, $createdMealCategory);
    }

    /**
     * @test read
     */
    public function test_read_meal_category()
    {
        $mealCategory = MealCategory::factory()->create();

        $dbMealCategory = $this->mealCategoryRepo->find($mealCategory->id);

        $dbMealCategory = $dbMealCategory->toArray();
        $this->assertModelData($mealCategory->toArray(), $dbMealCategory);
    }

    /**
     * @test update
     */
    public function test_update_meal_category()
    {
        $mealCategory = MealCategory::factory()->create();
        $fakeMealCategory = MealCategory::factory()->make()->toArray();

        $updatedMealCategory = $this->mealCategoryRepo->update($fakeMealCategory, $mealCategory->id);

        $this->assertModelData($fakeMealCategory, $updatedMealCategory->toArray());
        $dbMealCategory = $this->mealCategoryRepo->find($mealCategory->id);
        $this->assertModelData($fakeMealCategory, $dbMealCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_meal_category()
    {
        $mealCategory = MealCategory::factory()->create();

        $resp = $this->mealCategoryRepo->delete($mealCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(MealCategory::find($mealCategory->id), 'MealCategory should not exist in DB');
    }
}
