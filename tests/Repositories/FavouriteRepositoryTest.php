<?php namespace Tests\Repositories;

use App\Models\Favourite;
use App\Repositories\FavouriteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FavouriteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FavouriteRepository
     */
    protected $favouriteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->favouriteRepo = \App::make(FavouriteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_favourite()
    {
        $favourite = Favourite::factory()->make()->toArray();

        $createdFavourite = $this->favouriteRepo->create($favourite);

        $createdFavourite = $createdFavourite->toArray();
        $this->assertArrayHasKey('id', $createdFavourite);
        $this->assertNotNull($createdFavourite['id'], 'Created Favourite must have id specified');
        $this->assertNotNull(Favourite::find($createdFavourite['id']), 'Favourite with given id must be in DB');
        $this->assertModelData($favourite, $createdFavourite);
    }

    /**
     * @test read
     */
    public function test_read_favourite()
    {
        $favourite = Favourite::factory()->create();

        $dbFavourite = $this->favouriteRepo->find($favourite->id);

        $dbFavourite = $dbFavourite->toArray();
        $this->assertModelData($favourite->toArray(), $dbFavourite);
    }

    /**
     * @test update
     */
    public function test_update_favourite()
    {
        $favourite = Favourite::factory()->create();
        $fakeFavourite = Favourite::factory()->make()->toArray();

        $updatedFavourite = $this->favouriteRepo->update($fakeFavourite, $favourite->id);

        $this->assertModelData($fakeFavourite, $updatedFavourite->toArray());
        $dbFavourite = $this->favouriteRepo->find($favourite->id);
        $this->assertModelData($fakeFavourite, $dbFavourite->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_favourite()
    {
        $favourite = Favourite::factory()->create();

        $resp = $this->favouriteRepo->delete($favourite->id);

        $this->assertTrue($resp);
        $this->assertNull(Favourite::find($favourite->id), 'Favourite should not exist in DB');
    }
}
