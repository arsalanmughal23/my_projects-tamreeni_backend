<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UserEvent;

class UserEventApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_event()
    {
        $userEvent = UserEvent::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_events', $userEvent
        );

        $this->assertApiResponse($userEvent);
    }

    /**
     * @test
     */
    public function test_read_user_event()
    {
        $userEvent = UserEvent::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_events/'.$userEvent->id
        );

        $this->assertApiResponse($userEvent->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_event()
    {
        $userEvent = UserEvent::factory()->create();
        $editedUserEvent = UserEvent::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_events/'.$userEvent->id,
            $editedUserEvent
        );

        $this->assertApiResponse($editedUserEvent);
    }

    /**
     * @test
     */
    public function test_delete_user_event()
    {
        $userEvent = UserEvent::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_events/'.$userEvent->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_events/'.$userEvent->id
        );

        $this->response->assertStatus(404);
    }
}
