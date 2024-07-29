<?php namespace Tests\Repositories;

use App\Models\PromoCode;
use App\Repositories\PromoCodeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PromoCodeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PromoCodeRepository
     */
    protected $promoCodeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->promoCodeRepo = \App::make(PromoCodeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_promo_code()
    {
        $promoCode = PromoCode::factory()->make()->toArray();

        $createdPromoCode = $this->promoCodeRepo->create($promoCode);

        $createdPromoCode = $createdPromoCode->toArray();
        $this->assertArrayHasKey('id', $createdPromoCode);
        $this->assertNotNull($createdPromoCode['id'], 'Created PromoCode must have id specified');
        $this->assertNotNull(PromoCode::find($createdPromoCode['id']), 'PromoCode with given id must be in DB');
        $this->assertModelData($promoCode, $createdPromoCode);
    }

    /**
     * @test read
     */
    public function test_read_promo_code()
    {
        $promoCode = PromoCode::factory()->create();

        $dbPromoCode = $this->promoCodeRepo->find($promoCode->id);

        $dbPromoCode = $dbPromoCode->toArray();
        $this->assertModelData($promoCode->toArray(), $dbPromoCode);
    }

    /**
     * @test update
     */
    public function test_update_promo_code()
    {
        $promoCode = PromoCode::factory()->create();
        $fakePromoCode = PromoCode::factory()->make()->toArray();

        $updatedPromoCode = $this->promoCodeRepo->update($fakePromoCode, $promoCode->id);

        $this->assertModelData($fakePromoCode, $updatedPromoCode->toArray());
        $dbPromoCode = $this->promoCodeRepo->find($promoCode->id);
        $this->assertModelData($fakePromoCode, $dbPromoCode->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_promo_code()
    {
        $promoCode = PromoCode::factory()->create();

        $resp = $this->promoCodeRepo->delete($promoCode->id);

        $this->assertTrue($resp);
        $this->assertNull(PromoCode::find($promoCode->id), 'PromoCode should not exist in DB');
    }
}
