<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MembershipDuration;

class MembershipDurationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/membership_durations', $membershipDuration
        );

        $this->assertApiResponse($membershipDuration);
    }

    /**
     * @test
     */
    public function test_read_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/membership_durations/'.$membershipDuration->id
        );

        $this->assertApiResponse($membershipDuration->toArray());
    }

    /**
     * @test
     */
    public function test_update_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->create();
        $editedMembershipDuration = MembershipDuration::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/membership_durations/'.$membershipDuration->id,
            $editedMembershipDuration
        );

        $this->assertApiResponse($editedMembershipDuration);
    }

    /**
     * @test
     */
    public function test_delete_membership_duration()
    {
        $membershipDuration = MembershipDuration::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/membership_durations/'.$membershipDuration->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/membership_durations/'.$membershipDuration->id
        );

        $this->response->assertStatus(404);
    }
}
