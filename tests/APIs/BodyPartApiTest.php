<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\BodyPart;

class BodyPartApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_body_part()
    {
        $bodyPart = BodyPart::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/body_parts', $bodyPart
        );

        $this->assertApiResponse($bodyPart);
    }

    /**
     * @test
     */
    public function test_read_body_part()
    {
        $bodyPart = BodyPart::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/body_parts/'.$bodyPart->id
        );

        $this->assertApiResponse($bodyPart->toArray());
    }

    /**
     * @test
     */
    public function test_update_body_part()
    {
        $bodyPart = BodyPart::factory()->create();
        $editedBodyPart = BodyPart::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/body_parts/'.$bodyPart->id,
            $editedBodyPart
        );

        $this->assertApiResponse($editedBodyPart);
    }

    /**
     * @test
     */
    public function test_delete_body_part()
    {
        $bodyPart = BodyPart::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/body_parts/'.$bodyPart->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/body_parts/'.$bodyPart->id
        );

        $this->response->assertStatus(404);
    }
}
