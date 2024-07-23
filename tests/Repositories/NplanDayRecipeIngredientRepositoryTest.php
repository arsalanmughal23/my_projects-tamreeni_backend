<?php namespace Tests\Repositories;

use App\Models\NplanDayRecipeIngredient;
use App\Repositories\NplanDayRecipeIngredientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NplanDayRecipeIngredientRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NplanDayRecipeIngredientRepository
     */
    protected $nplanDayRecipeIngredientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->nplanDayRecipeIngredientRepo = \App::make(NplanDayRecipeIngredientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->make()->toArray();

        $createdNplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepo->create($nplanDayRecipeIngredient);

        $createdNplanDayRecipeIngredient = $createdNplanDayRecipeIngredient->toArray();
        $this->assertArrayHasKey('id', $createdNplanDayRecipeIngredient);
        $this->assertNotNull($createdNplanDayRecipeIngredient['id'], 'Created NplanDayRecipeIngredient must have id specified');
        $this->assertNotNull(NplanDayRecipeIngredient::find($createdNplanDayRecipeIngredient['id']), 'NplanDayRecipeIngredient with given id must be in DB');
        $this->assertModelData($nplanDayRecipeIngredient, $createdNplanDayRecipeIngredient);
    }

    /**
     * @test read
     */
    public function test_read_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->create();

        $dbNplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepo->find($nplanDayRecipeIngredient->id);

        $dbNplanDayRecipeIngredient = $dbNplanDayRecipeIngredient->toArray();
        $this->assertModelData($nplanDayRecipeIngredient->toArray(), $dbNplanDayRecipeIngredient);
    }

    /**
     * @test update
     */
    public function test_update_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->create();
        $fakeNplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->make()->toArray();

        $updatedNplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepo->update($fakeNplanDayRecipeIngredient, $nplanDayRecipeIngredient->id);

        $this->assertModelData($fakeNplanDayRecipeIngredient, $updatedNplanDayRecipeIngredient->toArray());
        $dbNplanDayRecipeIngredient = $this->nplanDayRecipeIngredientRepo->find($nplanDayRecipeIngredient->id);
        $this->assertModelData($fakeNplanDayRecipeIngredient, $dbNplanDayRecipeIngredient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_nplan_day_recipe_ingredient()
    {
        $nplanDayRecipeIngredient = NplanDayRecipeIngredient::factory()->create();

        $resp = $this->nplanDayRecipeIngredientRepo->delete($nplanDayRecipeIngredient->id);

        $this->assertTrue($resp);
        $this->assertNull(NplanDayRecipeIngredient::find($nplanDayRecipeIngredient->id), 'NplanDayRecipeIngredient should not exist in DB');
    }
}
