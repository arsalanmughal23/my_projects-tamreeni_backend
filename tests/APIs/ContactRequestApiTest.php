<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ContactRequest;

class ContactRequestApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contact_request()
    {
        $contactRequest = ContactRequest::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contact_requests', $contactRequest
        );

        $this->assertApiResponse($contactRequest);
    }

    /**
     * @test
     */
    public function test_read_contact_request()
    {
        $contactRequest = ContactRequest::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contact_requests/'.$contactRequest->id
        );

        $this->assertApiResponse($contactRequest->toArray());
    }

    /**
     * @test
     */
    public function test_update_contact_request()
    {
        $contactRequest = ContactRequest::factory()->create();
        $editedContactRequest = ContactRequest::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contact_requests/'.$contactRequest->id,
            $editedContactRequest
        );

        $this->assertApiResponse($editedContactRequest);
    }

    /**
     * @test
     */
    public function test_delete_contact_request()
    {
        $contactRequest = ContactRequest::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contact_requests/'.$contactRequest->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contact_requests/'.$contactRequest->id
        );

        $this->response->assertStatus(404);
    }
}
