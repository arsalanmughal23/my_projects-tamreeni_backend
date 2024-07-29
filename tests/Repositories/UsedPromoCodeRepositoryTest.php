<?php namespace Tests\Repositories;

use App\Models\UsedPromoCode;
use App\Repositories\UsedPromoCodeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UsedPromoCodeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UsedPromoCodeRepository
     */
    protected $usedPromoCodeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->usedPromoCodeRepo = \App::make(UsedPromoCodeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->make()->toArray();

        $createdUsedPromoCode = $this->usedPromoCodeRepo->create($usedPromoCode);

        $createdUsedPromoCode = $createdUsedPromoCode->toArray();
        $this->assertArrayHasKey('id', $createdUsedPromoCode);
        $this->assertNotNull($createdUsedPromoCode['id'], 'Created UsedPromoCode must have id specified');
        $this->assertNotNull(UsedPromoCode::find($createdUsedPromoCode['id']), 'UsedPromoCode with given id must be in DB');
        $this->assertModelData($usedPromoCode, $createdUsedPromoCode);
    }

    /**
     * @test read
     */
    public function test_read_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->create();

        $dbUsedPromoCode = $this->usedPromoCodeRepo->find($usedPromoCode->id);

        $dbUsedPromoCode = $dbUsedPromoCode->toArray();
        $this->assertModelData($usedPromoCode->toArray(), $dbUsedPromoCode);
    }

    /**
     * @test update
     */
    public function test_update_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->create();
        $fakeUsedPromoCode = UsedPromoCode::factory()->make()->toArray();

        $updatedUsedPromoCode = $this->usedPromoCodeRepo->update($fakeUsedPromoCode, $usedPromoCode->id);

        $this->assertModelData($fakeUsedPromoCode, $updatedUsedPromoCode->toArray());
        $dbUsedPromoCode = $this->usedPromoCodeRepo->find($usedPromoCode->id);
        $this->assertModelData($fakeUsedPromoCode, $dbUsedPromoCode->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_used_promo_code()
    {
        $usedPromoCode = UsedPromoCode::factory()->create();

        $resp = $this->usedPromoCodeRepo->delete($usedPromoCode->id);

        $this->assertTrue($resp);
        $this->assertNull(UsedPromoCode::find($usedPromoCode->id), 'UsedPromoCode should not exist in DB');
    }
}
