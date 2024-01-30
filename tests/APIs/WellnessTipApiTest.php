<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\WellnessTip;

class WellnessTipApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/wellness_tips', $wellnessTip
        );

        $this->assertApiResponse($wellnessTip);
    }

    /**
     * @test
     */
    public function test_read_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/wellness_tips/'.$wellnessTip->id
        );

        $this->assertApiResponse($wellnessTip->toArray());
    }

    /**
     * @test
     */
    public function test_update_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->create();
        $editedWellnessTip = WellnessTip::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/wellness_tips/'.$wellnessTip->id,
            $editedWellnessTip
        );

        $this->assertApiResponse($editedWellnessTip);
    }

    /**
     * @test
     */
    public function test_delete_wellness_tip()
    {
        $wellnessTip = WellnessTip::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/wellness_tips/'.$wellnessTip->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/wellness_tips/'.$wellnessTip->id
        );

        $this->response->assertStatus(404);
    }
}
