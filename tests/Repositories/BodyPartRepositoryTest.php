<?php namespace Tests\Repositories;

use App\Models\BodyPart;
use App\Repositories\BodyPartRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BodyPartRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BodyPartRepository
     */
    protected $bodyPartRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bodyPartRepo = \App::make(BodyPartRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_body_part()
    {
        $bodyPart = BodyPart::factory()->make()->toArray();

        $createdBodyPart = $this->bodyPartRepo->create($bodyPart);

        $createdBodyPart = $createdBodyPart->toArray();
        $this->assertArrayHasKey('id', $createdBodyPart);
        $this->assertNotNull($createdBodyPart['id'], 'Created BodyPart must have id specified');
        $this->assertNotNull(BodyPart::find($createdBodyPart['id']), 'BodyPart with given id must be in DB');
        $this->assertModelData($bodyPart, $createdBodyPart);
    }

    /**
     * @test read
     */
    public function test_read_body_part()
    {
        $bodyPart = BodyPart::factory()->create();

        $dbBodyPart = $this->bodyPartRepo->find($bodyPart->id);

        $dbBodyPart = $dbBodyPart->toArray();
        $this->assertModelData($bodyPart->toArray(), $dbBodyPart);
    }

    /**
     * @test update
     */
    public function test_update_body_part()
    {
        $bodyPart = BodyPart::factory()->create();
        $fakeBodyPart = BodyPart::factory()->make()->toArray();

        $updatedBodyPart = $this->bodyPartRepo->update($fakeBodyPart, $bodyPart->id);

        $this->assertModelData($fakeBodyPart, $updatedBodyPart->toArray());
        $dbBodyPart = $this->bodyPartRepo->find($bodyPart->id);
        $this->assertModelData($fakeBodyPart, $dbBodyPart->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_body_part()
    {
        $bodyPart = BodyPart::factory()->create();

        $resp = $this->bodyPartRepo->delete($bodyPart->id);

        $this->assertTrue($resp);
        $this->assertNull(BodyPart::find($bodyPart->id), 'BodyPart should not exist in DB');
    }
}
