<?php namespace Tests\Repositories;

use App\Models\UserEvent;
use App\Repositories\UserEventRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserEventRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserEventRepository
     */
    protected $userEventRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userEventRepo = \App::make(UserEventRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_event()
    {
        $userEvent = UserEvent::factory()->make()->toArray();

        $createdUserEvent = $this->userEventRepo->create($userEvent);

        $createdUserEvent = $createdUserEvent->toArray();
        $this->assertArrayHasKey('id', $createdUserEvent);
        $this->assertNotNull($createdUserEvent['id'], 'Created UserEvent must have id specified');
        $this->assertNotNull(UserEvent::find($createdUserEvent['id']), 'UserEvent with given id must be in DB');
        $this->assertModelData($userEvent, $createdUserEvent);
    }

    /**
     * @test read
     */
    public function test_read_user_event()
    {
        $userEvent = UserEvent::factory()->create();

        $dbUserEvent = $this->userEventRepo->find($userEvent->id);

        $dbUserEvent = $dbUserEvent->toArray();
        $this->assertModelData($userEvent->toArray(), $dbUserEvent);
    }

    /**
     * @test update
     */
    public function test_update_user_event()
    {
        $userEvent = UserEvent::factory()->create();
        $fakeUserEvent = UserEvent::factory()->make()->toArray();

        $updatedUserEvent = $this->userEventRepo->update($fakeUserEvent, $userEvent->id);

        $this->assertModelData($fakeUserEvent, $updatedUserEvent->toArray());
        $dbUserEvent = $this->userEventRepo->find($userEvent->id);
        $this->assertModelData($fakeUserEvent, $dbUserEvent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_event()
    {
        $userEvent = UserEvent::factory()->create();

        $resp = $this->userEventRepo->delete($userEvent->id);

        $this->assertTrue($resp);
        $this->assertNull(UserEvent::find($userEvent->id), 'UserEvent should not exist in DB');
    }
}
