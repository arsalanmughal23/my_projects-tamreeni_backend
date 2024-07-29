<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserMembership;

class UserMembershipApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_membership()
    {
        $userMembership = UserMembership::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_memberships', $userMembership
        );

        $this->assertApiResponse($userMembership);
    }

    /**
     * @test
     */
    public function test_read_user_membership()
    {
        $userMembership = UserMembership::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_memberships/'.$userMembership->id
        );

        $this->assertApiResponse($userMembership->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_membership()
    {
        $userMembership = UserMembership::factory()->create();
        $editedUserMembership = UserMembership::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_memberships/'.$userMembership->id,
            $editedUserMembership
        );

        $this->assertApiResponse($editedUserMembership);
    }

    /**
     * @test
     */
    public function test_delete_user_membership()
    {
        $userMembership = UserMembership::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_memberships/'.$userMembership->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_memberships/'.$userMembership->id
        );

        $this->response->assertStatus(404);
    }
}
