<?php namespace Tests\Repositories;

use App\Models\ContactRequest;
use App\Repositories\ContactRequestRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContactRequestRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContactRequestRepository
     */
    protected $contactRequestRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contactRequestRepo = \App::make(ContactRequestRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contact_request()
    {
        $contactRequest = ContactRequest::factory()->make()->toArray();

        $createdContactRequest = $this->contactRequestRepo->create($contactRequest);

        $createdContactRequest = $createdContactRequest->toArray();
        $this->assertArrayHasKey('id', $createdContactRequest);
        $this->assertNotNull($createdContactRequest['id'], 'Created ContactRequest must have id specified');
        $this->assertNotNull(ContactRequest::find($createdContactRequest['id']), 'ContactRequest with given id must be in DB');
        $this->assertModelData($contactRequest, $createdContactRequest);
    }

    /**
     * @test read
     */
    public function test_read_contact_request()
    {
        $contactRequest = ContactRequest::factory()->create();

        $dbContactRequest = $this->contactRequestRepo->find($contactRequest->id);

        $dbContactRequest = $dbContactRequest->toArray();
        $this->assertModelData($contactRequest->toArray(), $dbContactRequest);
    }

    /**
     * @test update
     */
    public function test_update_contact_request()
    {
        $contactRequest = ContactRequest::factory()->create();
        $fakeContactRequest = ContactRequest::factory()->make()->toArray();

        $updatedContactRequest = $this->contactRequestRepo->update($fakeContactRequest, $contactRequest->id);

        $this->assertModelData($fakeContactRequest, $updatedContactRequest->toArray());
        $dbContactRequest = $this->contactRequestRepo->find($contactRequest->id);
        $this->assertModelData($fakeContactRequest, $dbContactRequest->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_contact_request()
    {
        $contactRequest = ContactRequest::factory()->create();

        $resp = $this->contactRequestRepo->delete($contactRequest->id);

        $this->assertTrue($resp);
        $this->assertNull(ContactRequest::find($contactRequest->id), 'ContactRequest should not exist in DB');
    }
}
