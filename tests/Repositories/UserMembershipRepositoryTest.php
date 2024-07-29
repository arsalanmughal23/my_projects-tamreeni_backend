<?php namespace Tests\Repositories;

use App\Models\UserMembership;
use App\Repositories\UserMembershipRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserMembershipRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserMembershipRepository
     */
    protected $userMembershipRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userMembershipRepo = \App::make(UserMembershipRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_membership()
    {
        $userMembership = UserMembership::factory()->make()->toArray();

        $createdUserMembership = $this->userMembershipRepo->create($userMembership);

        $createdUserMembership = $createdUserMembership->toArray();
        $this->assertArrayHasKey('id', $createdUserMembership);
        $this->assertNotNull($createdUserMembership['id'], 'Created UserMembership must have id specified');
        $this->assertNotNull(UserMembership::find($createdUserMembership['id']), 'UserMembership with given id must be in DB');
        $this->assertModelData($userMembership, $createdUserMembership);
    }

    /**
     * @test read
     */
    public function test_read_user_membership()
    {
        $userMembership = UserMembership::factory()->create();

        $dbUserMembership = $this->userMembershipRepo->find($userMembership->id);

        $dbUserMembership = $dbUserMembership->toArray();
        $this->assertModelData($userMembership->toArray(), $dbUserMembership);
    }

    /**
     * @test update
     */
    public function test_update_user_membership()
    {
        $userMembership = UserMembership::factory()->create();
        $fakeUserMembership = UserMembership::factory()->make()->toArray();

        $updatedUserMembership = $this->userMembershipRepo->update($fakeUserMembership, $userMembership->id);

        $this->assertModelData($fakeUserMembership, $updatedUserMembership->toArray());
        $dbUserMembership = $this->userMembershipRepo->find($userMembership->id);
        $this->assertModelData($fakeUserMembership, $dbUserMembership->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_membership()
    {
        $userMembership = UserMembership::factory()->create();

        $resp = $this->userMembershipRepo->delete($userMembership->id);

        $this->assertTrue($resp);
        $this->assertNull(UserMembership::find($userMembership->id), 'UserMembership should not exist in DB');
    }
}
