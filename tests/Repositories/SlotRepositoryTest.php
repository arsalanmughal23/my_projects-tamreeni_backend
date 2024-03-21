<?php namespace Tests\Repositories;

use App\Models\Slot;
use App\Repositories\SlotRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SlotRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SlotRepository
     */
    protected $slotRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->slotRepo = \App::make(SlotRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_slot()
    {
        $slot = Slot::factory()->make()->toArray();

        $createdSlot = $this->slotRepo->create($slot);

        $createdSlot = $createdSlot->toArray();
        $this->assertArrayHasKey('id', $createdSlot);
        $this->assertNotNull($createdSlot['id'], 'Created Slot must have id specified');
        $this->assertNotNull(Slot::find($createdSlot['id']), 'Slot with given id must be in DB');
        $this->assertModelData($slot, $createdSlot);
    }

    /**
     * @test read
     */
    public function test_read_slot()
    {
        $slot = Slot::factory()->create();

        $dbSlot = $this->slotRepo->find($slot->id);

        $dbSlot = $dbSlot->toArray();
        $this->assertModelData($slot->toArray(), $dbSlot);
    }

    /**
     * @test update
     */
    public function test_update_slot()
    {
        $slot = Slot::factory()->create();
        $fakeSlot = Slot::factory()->make()->toArray();

        $updatedSlot = $this->slotRepo->update($fakeSlot, $slot->id);

        $this->assertModelData($fakeSlot, $updatedSlot->toArray());
        $dbSlot = $this->slotRepo->find($slot->id);
        $this->assertModelData($fakeSlot, $dbSlot->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_slot()
    {
        $slot = Slot::factory()->create();

        $resp = $this->slotRepo->delete($slot->id);

        $this->assertTrue($resp);
        $this->assertNull(Slot::find($slot->id), 'Slot should not exist in DB');
    }
}
