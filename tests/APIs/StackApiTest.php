<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Stack;

class StackApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stack()
    {
        $stack = Stack::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stacks', $stack
        );

        $this->assertApiResponse($stack);
    }

    /**
     * @test
     */
    public function test_read_stack()
    {
        $stack = Stack::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stacks/'.$stack->id
        );

        $this->assertApiResponse($stack->toArray());
    }

    /**
     * @test
     */
    public function test_update_stack()
    {
        $stack = Stack::factory()->create();
        $editedStack = Stack::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stacks/'.$stack->id,
            $editedStack
        );

        $this->assertApiResponse($editedStack);
    }

    /**
     * @test
     */
    public function test_delete_stack()
    {
        $stack = Stack::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stacks/'.$stack->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stacks/'.$stack->id
        );

        $this->response->assertStatus(404);
    }
}
