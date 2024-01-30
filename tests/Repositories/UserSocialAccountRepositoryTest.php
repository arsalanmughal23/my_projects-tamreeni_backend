<?php namespace Tests\Repositories;

use App\Models\UserSocialAccount;
use App\Repositories\UserSocialAccountRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserSocialAccountRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserSocialAccountRepository
     */
    protected $userSocialAccountRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userSocialAccountRepo = \App::make(UserSocialAccountRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->make()->toArray();

        $createdUserSocialAccount = $this->userSocialAccountRepo->create($userSocialAccount);

        $createdUserSocialAccount = $createdUserSocialAccount->toArray();
        $this->assertArrayHasKey('id', $createdUserSocialAccount);
        $this->assertNotNull($createdUserSocialAccount['id'], 'Created UserSocialAccount must have id specified');
        $this->assertNotNull(UserSocialAccount::find($createdUserSocialAccount['id']), 'UserSocialAccount with given id must be in DB');
        $this->assertModelData($userSocialAccount, $createdUserSocialAccount);
    }

    /**
     * @test read
     */
    public function test_read_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->create();

        $dbUserSocialAccount = $this->userSocialAccountRepo->find($userSocialAccount->id);

        $dbUserSocialAccount = $dbUserSocialAccount->toArray();
        $this->assertModelData($userSocialAccount->toArray(), $dbUserSocialAccount);
    }

    /**
     * @test update
     */
    public function test_update_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->create();
        $fakeUserSocialAccount = UserSocialAccount::factory()->make()->toArray();

        $updatedUserSocialAccount = $this->userSocialAccountRepo->update($fakeUserSocialAccount, $userSocialAccount->id);

        $this->assertModelData($fakeUserSocialAccount, $updatedUserSocialAccount->toArray());
        $dbUserSocialAccount = $this->userSocialAccountRepo->find($userSocialAccount->id);
        $this->assertModelData($fakeUserSocialAccount, $dbUserSocialAccount->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_social_account()
    {
        $userSocialAccount = UserSocialAccount::factory()->create();

        $resp = $this->userSocialAccountRepo->delete($userSocialAccount->id);

        $this->assertTrue($resp);
        $this->assertNull(UserSocialAccount::find($userSocialAccount->id), 'UserSocialAccount should not exist in DB');
    }
}
