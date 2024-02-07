<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserSocialAccount;

class UserSocialAccountApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_social_accounts', $userSocialAccount
        );

        $this->assertApiResponse($userSocialAccount);
    }

    /**
     * @test
     */
    public function test_read_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_social_accounts/'.$userSocialAccount->id
        );

        $this->assertApiResponse($userSocialAccount->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->create();
        $editedUserSocialAccount = UserSocialAccount::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_social_accounts/'.$userSocialAccount->id,
            $editedUserSocialAccount
        );

        $this->assertApiResponse($editedUserSocialAccount);
    }

    /**
     * @test
     */
    public function test_delete_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_social_accounts/'.$userSocialAccount->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_social_accounts/'.$userSocialAccount->id
        );

        $this->response->assertStatus(404);
    }
}
