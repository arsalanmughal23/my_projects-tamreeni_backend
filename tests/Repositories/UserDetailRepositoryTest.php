<?php namespace Tests\Repositories;

use App\Models\UserDetail;
use App\Repositories\UserDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserDetailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserDetailRepository
     */
    protected $userDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userDetailRepo = \App::make(UserDetailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_detail()
    {
        $userDetail = UserDetail::factory()->make()->toArray();

        $createdUserDetail = $this->userDetailRepo->create($userDetail);

        $createdUserDetail = $createdUserDetail->toArray();
        $this->assertArrayHasKey('id', $createdUserDetail);
        $this->assertNotNull($createdUserDetail['id'], 'Created UserDetail must have id specified');
        $this->assertNotNull(UserDetail::find($createdUserDetail['id']), 'UserDetail with given id must be in DB');
        $this->assertModelData($userDetail, $createdUserDetail);
    }

    /**
     * @test read
     */
    public function test_read_user_detail()
    {
        $userDetail = UserDetail::factory()->create();

        $dbUserDetail = $this->userDetailRepo->find($userDetail->id);

        $dbUserDetail = $dbUserDetail->toArray();
        $this->assertModelData($userDetail->toArray(), $dbUserDetail);
    }

    /**
     * @test update
     */
    public function test_update_user_detail()
    {
        $userDetail = UserDetail::factory()->create();
        $fakeUserDetail = UserDetail::factory()->make()->toArray();

        $updatedUserDetail = $this->userDetailRepo->update($fakeUserDetail, $userDetail->id);

        $this->assertModelData($fakeUserDetail, $updatedUserDetail->toArray());
        $dbUserDetail = $this->userDetailRepo->find($userDetail->id);
        $this->assertModelData($fakeUserDetail, $dbUserDetail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_detail()
    {
        $userDetail = UserDetail::factory()->create();

        $resp = $this->userDetailRepo->delete($userDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(UserDetail::find($userDetail->id), 'UserDetail should not exist in DB');
    }
}
