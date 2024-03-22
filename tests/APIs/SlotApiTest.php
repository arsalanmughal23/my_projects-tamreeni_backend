<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Slot;

class SlotApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_slot()
    {
        $slot = Slot::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/slots', $slot
        );

        $this->assertApiResponse($slot);
    }

    /**
     * @test
     */
    public function test_read_slot()
    {
        $slot = Slot::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/slots/'.$slot->id
        );

        $this->assertApiResponse($slot->toArray());
    }

    /**
     * @test
     */
    public function test_update_slot()
    {
        $slot = Slot::factory()->create();
        $editedSlot = Slot::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/slots/'.$slot->id,
            $editedSlot
        );

        $this->assertApiResponse($editedSlot);
    }

    /**
     * @test
     */
    public function test_delete_slot()
    {
        $slot = Slot::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/slots/'.$slot->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/slots/'.$slot->id
        );

        $this->response->assertStatus(404);
    }
}
