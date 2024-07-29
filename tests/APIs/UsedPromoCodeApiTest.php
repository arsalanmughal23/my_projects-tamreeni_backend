<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UsedPromoCode;

class UsedPromoCodeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/used_promo_codes', $usedPromoCode
        );

        $this->assertApiResponse($usedPromoCode);
    }

    /**
     * @test
     */
    public function test_read_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/used_promo_codes/'.$usedPromoCode->id
        );

        $this->assertApiResponse($usedPromoCode->toArray());
    }

    /**
     * @test
     */
    public function test_update_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->create();
        $editedUsedPromoCode = UsedPromoCode::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/used_promo_codes/'.$usedPromoCode->id,
            $editedUsedPromoCode
        );

        $this->assertApiResponse($editedUsedPromoCode);
    }

    /**
     * @test
     */
    public function test_delete_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/used_promo_codes/'.$usedPromoCode->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/used_promo_codes/'.$usedPromoCode->id
        );

        $this->response->assertStatus(404);
    }
}
