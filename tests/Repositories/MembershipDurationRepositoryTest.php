<?php namespace Tests\Repositories;

use App\Models\MembershipDuration;
use App\Repositories\MembershipDurationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MembershipDurationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MembershipDurationRepository
     */
    protected $membershipDurationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->membershipDurationRepo = \App::make(MembershipDurationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->make()->toArray();

        $createdMembershipDuration = $this->membershipDurationRepo->create($membershipDuration);

        $createdMembershipDuration = $createdMembershipDuration->toArray();
        $this->assertArrayHasKey('id', $createdMembershipDuration);
        $this->assertNotNull($createdMembershipDuration['id'], 'Created MembershipDuration must have id specified');
        $this->assertNotNull(MembershipDuration::find($createdMembershipDuration['id']), 'MembershipDuration with given id must be in DB');
        $this->assertModelData($membershipDuration, $createdMembershipDuration);
    }

    /**
     * @test read
     */
    public function test_read_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->create();

        $dbMembershipDuration = $this->membershipDurationRepo->find($membershipDuration->id);

        $dbMembershipDuration = $dbMembershipDuration->toArray();
        $this->assertModelData($membershipDuration->toArray(), $dbMembershipDuration);
    }

    /**
     * @test update
     */
    public function test_update_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->create();
        $fakeMembershipDuration = MembershipDuration::factory()->make()->toArray();

        $updatedMembershipDuration = $this->membershipDurationRepo->update($fakeMembershipDuration, $membershipDuration->id);

        $this->assertModelData($fakeMembershipDuration, $updatedMembershipDuration->toArray());
        $dbMembershipDuration = $this->membershipDurationRepo->find($membershipDuration->id);
        $this->assertModelData($fakeMembershipDuration, $dbMembershipDuration->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->create();

        $resp = $this->membershipDurationRepo->delete($membershipDuration->id);

        $this->assertTrue($resp);
        $this->assertNull(MembershipDuration::find($membershipDuration->id), 'MembershipDuration should not exist in DB');
    }
}
