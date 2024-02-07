<?php namespace Tests\Repositories;

use App\Models\UserDevice;
use App\Repositories\UserDeviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserDeviceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserDeviceRepository
     */
    protected $userDeviceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userDeviceRepo = \App::make(UserDeviceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_device()
    {
        $userDevice = UserDevice::factory()->make()->toArray();

        $createdUserDevice = $this->userDeviceRepo->create($userDevice);

        $createdUserDevice = $createdUserDevice->toArray();
        $this->assertArrayHasKey('id', $createdUserDevice);
        $this->assertNotNull($createdUserDevice['id'], 'Created UserDevice must have id specified');
        $this->assertNotNull(UserDevice::find($createdUserDevice['id']), 'UserDevice with given id must be in DB');
        $this->assertModelData($userDevice, $createdUserDevice);
    }

    /**
     * @test read
     */
    public function test_read_user_device()
    {
        $userDevice = UserDevice::factory()->create();

        $dbUserDevice = $this->userDeviceRepo->find($userDevice->id);

        $dbUserDevice = $dbUserDevice->toArray();
        $this->assertModelData($userDevice->toArray(), $dbUserDevice);
    }

    /**
     * @test update
     */
    public function test_update_user_device()
    {
        $userDevice = UserDevice::factory()->create();
        $fakeUserDevice = UserDevice::factory()->make()->toArray();

        $updatedUserDevice = $this->userDeviceRepo->update($fakeUserDevice, $userDevice->id);

        $this->assertModelData($fakeUserDevice, $updatedUserDevice->toArray());
        $dbUserDevice = $this->userDeviceRepo->find($userDevice->id);
        $this->assertModelData($fakeUserDevice, $dbUserDevice->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_device()
    {
        $userDevice = UserDevice::factory()->create();

        $resp = $this->userDeviceRepo->delete($userDevice->id);

        $this->assertTrue($resp);
        $this->assertNull(UserDevice::find($userDevice->id), 'UserDevice should not exist in DB');
    }
}
