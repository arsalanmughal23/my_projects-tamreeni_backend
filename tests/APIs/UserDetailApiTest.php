<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserDetail;

class UserDetailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_detail()
    {
        $userDetail = UserDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_details', $userDetail
        );

        $this->assertApiResponse($userDetail);
    }

    /**
     * @test
     */
    public function test_read_user_detail()
    {
        $userDetail = UserDetail::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_details/'.$userDetail->id
        );

        $this->assertApiResponse($userDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_detail()
    {
        $userDetail = UserDetail::factory()->create();
        $editedUserDetail = UserDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_details/'.$userDetail->id,
            $editedUserDetail
        );

        $this->assertApiResponse($editedUserDetail);
    }

    /**
     * @test
     */
    public function test_delete_user_detail()
    {
        $userDetail = UserDetail::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_details/'.$userDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_details/'.$userDetail->id
        );

        $this->response->assertStatus(404);
    }
}
