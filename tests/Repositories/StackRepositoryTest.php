<?php namespace Tests\Repositories;

use App\Models\Stack;
use App\Repositories\StackRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StackRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StackRepository
     */
    protected $stackRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stackRepo = \App::make(StackRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stack()
    {
        $stack = Stack::factory()->make()->toArray();

        $createdStack = $this->stackRepo->create($stack);

        $createdStack = $createdStack->toArray();
        $this->assertArrayHasKey('id', $createdStack);
        $this->assertNotNull($createdStack['id'], 'Created Stack must have id specified');
        $this->assertNotNull(Stack::find($createdStack['id']), 'Stack with given id must be in DB');
        $this->assertModelData($stack, $createdStack);
    }

    /**
     * @test read
     */
    public function test_read_stack()
    {
        $stack = Stack::factory()->create();

        $dbStack = $this->stackRepo->find($stack->id);

        $dbStack = $dbStack->toArray();
        $this->assertModelData($stack->toArray(), $dbStack);
    }

    /**
     * @test update
     */
    public function test_update_stack()
    {
        $stack = Stack::factory()->create();
        $fakeStack = Stack::factory()->make()->toArray();

        $updatedStack = $this->stackRepo->update($fakeStack, $stack->id);

        $this->assertModelData($fakeStack, $updatedStack->toArray());
        $dbStack = $this->stackRepo->find($stack->id);
        $this->assertModelData($fakeStack, $dbStack->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stack()
    {
        $stack = Stack::factory()->create();

        $resp = $this->stackRepo->delete($stack->id);

        $this->assertTrue($resp);
        $this->assertNull(Stack::find($stack->id), 'Stack should not exist in DB');
    }
}
