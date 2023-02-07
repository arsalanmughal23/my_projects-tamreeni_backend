<?php namespace Tests\Repositories;

use App\Models\Constant;
use App\Repositories\ConstantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ConstantRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConstantRepository
     */
    protected $constantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->constantRepo = \App::make(ConstantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_constant()
    {
        $constant = Constant::factory()->make()->toArray();

        $createdConstant = $this->constantRepo->create($constant);

        $createdConstant = $createdConstant->toArray();
        $this->assertArrayHasKey('id', $createdConstant);
        $this->assertNotNull($createdConstant['id'], 'Created Constant must have id specified');
        $this->assertNotNull(Constant::find($createdConstant['id']), 'Constant with given id must be in DB');
        $this->assertModelData($constant, $createdConstant);
    }

    /**
     * @test read
     */
    public function test_read_constant()
    {
        $constant = Constant::factory()->create();

        $dbConstant = $this->constantRepo->find($constant->id);

        $dbConstant = $dbConstant->toArray();
        $this->assertModelData($constant->toArray(), $dbConstant);
    }

    /**
     * @test update
     */
    public function test_update_constant()
    {
        $constant = Constant::factory()->create();
        $fakeConstant = Constant::factory()->make()->toArray();

        $updatedConstant = $this->constantRepo->update($fakeConstant, $constant->id);

        $this->assertModelData($fakeConstant, $updatedConstant->toArray());
        $dbConstant = $this->constantRepo->find($constant->id);
        $this->assertModelData($fakeConstant, $dbConstant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_constant()
    {
        $constant = Constant::factory()->create();

        $resp = $this->constantRepo->delete($constant->id);

        $this->assertTrue($resp);
        $this->assertNull(Constant::find($constant->id), 'Constant should not exist in DB');
    }
}
