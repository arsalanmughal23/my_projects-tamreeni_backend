<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PromoCode;

class PromoCodeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_promo_code()
    {
        $promoCode = PromoCode::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/promo_codes', $promoCode
        );

        $this->assertApiResponse($promoCode);
    }

    /**
     * @test
     */
    public function test_read_promo_code()
    {
        $promoCode = PromoCode::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/promo_codes/'.$promoCode->id
        );

        $this->assertApiResponse($promoCode->toArray());
    }

    /**
     * @test
     */
    public function test_update_promo_code()
    {
        $promoCode = PromoCode::factory()->create();
        $editedPromoCode = PromoCode::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/promo_codes/'.$promoCode->id,
            $editedPromoCode
        );

        $this->assertApiResponse($editedPromoCode);
    }

    /**
     * @test
     */
    public function test_delete_promo_code()
    {
        $promoCode = PromoCode::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/promo_codes/'.$promoCode->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/promo_codes/'.$promoCode->id
        );

        $this->response->assertStatus(404);
    }
}
