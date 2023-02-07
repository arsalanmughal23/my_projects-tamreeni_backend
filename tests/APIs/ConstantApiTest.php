<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Constant;

class ConstantApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_constant()
    {
        $constant = Constant::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/constants', $constant
        );

        $this->assertApiResponse($constant);
    }

    /**
     * @test
     */
    public function test_read_constant()
    {
        $constant = Constant::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/constants/'.$constant->id
        );

        $this->assertApiResponse($constant->toArray());
    }

    /**
     * @test
     */
    public function test_update_constant()
    {
        $constant = Constant::factory()->create();
        $editedConstant = Constant::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/constants/'.$constant->id,
            $editedConstant
        );

        $this->assertApiResponse($editedConstant);
    }

    /**
     * @test
     */
    public function test_delete_constant()
    {
        $constant = Constant::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/constants/'.$constant->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/constants/'.$constant->id
        );

        $this->response->assertStatus(404);
    }
}
