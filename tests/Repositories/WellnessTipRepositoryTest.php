<?php namespace Tests\Repositories;

use App\Models\WellnessTip;
use App\Repositories\WellnessTipRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WellnessTipRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WellnessTipRepository
     */
    protected $wellnessTipRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->wellnessTipRepo = \App::make(WellnessTipRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->make()->toArray();

        $createdWellnessTip = $this->wellnessTipRepo->create($wellnessTip);

        $createdWellnessTip = $createdWellnessTip->toArray();
        $this->assertArrayHasKey('id', $createdWellnessTip);
        $this->assertNotNull($createdWellnessTip['id'], 'Created WellnessTip must have id specified');
        $this->assertNotNull(WellnessTip::find($createdWellnessTip['id']), 'WellnessTip with given id must be in DB');
        $this->assertModelData($wellnessTip, $createdWellnessTip);
    }

    /**
     * @test read
     */
    public function test_read_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->create();

        $dbWellnessTip = $this->wellnessTipRepo->find($wellnessTip->id);

        $dbWellnessTip = $dbWellnessTip->toArray();
        $this->assertModelData($wellnessTip->toArray(), $dbWellnessTip);
    }

    /**
     * @test update
     */
    public function test_update_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->create();
        $fakeWellnessTip = WellnessTip::factory()->make()->toArray();

        $updatedWellnessTip = $this->wellnessTipRepo->update($fakeWellnessTip, $wellnessTip->id);

        $this->assertModelData($fakeWellnessTip, $updatedWellnessTip->toArray());
        $dbWellnessTip = $this->wellnessTipRepo->find($wellnessTip->id);
        $this->assertModelData($fakeWellnessTip, $dbWellnessTip->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->create();

        $resp = $this->wellnessTipRepo->delete($wellnessTip->id);

        $this->assertTrue($resp);
        $this->assertNull(WellnessTip::find($wellnessTip->id), 'WellnessTip should not exist in DB');
    }
}
