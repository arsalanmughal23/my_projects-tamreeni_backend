<?php namespace Tests\Repositories;

use App\Models\ExerciseEquipment;
use App\Repositories\ExerciseEquipmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ExerciseEquipmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExerciseEquipmentRepository
     */
    protected $exerciseEquipmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->exerciseEquipmentRepo = \App::make(ExerciseEquipmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->make()->toArray();

        $createdExerciseEquipment = $this->exerciseEquipmentRepo->create($exerciseEquipment);

        $createdExerciseEquipment = $createdExerciseEquipment->toArray();
        $this->assertArrayHasKey('id', $createdExerciseEquipment);
        $this->assertNotNull($createdExerciseEquipment['id'], 'Created ExerciseEquipment must have id specified');
        $this->assertNotNull(ExerciseEquipment::find($createdExerciseEquipment['id']), 'ExerciseEquipment with given id must be in DB');
        $this->assertModelData($exerciseEquipment, $createdExerciseEquipment);
    }

    /**
     * @test read
     */
    public function test_read_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->create();

        $dbExerciseEquipment = $this->exerciseEquipmentRepo->find($exerciseEquipment->id);

        $dbExerciseEquipment = $dbExerciseEquipment->toArray();
        $this->assertModelData($exerciseEquipment->toArray(), $dbExerciseEquipment);
    }

    /**
     * @test update
     */
    public function test_update_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->create();
        $fakeExerciseEquipment = ExerciseEquipment::factory()->make()->toArray();

        $updatedExerciseEquipment = $this->exerciseEquipmentRepo->update($fakeExerciseEquipment, $exerciseEquipment->id);

        $this->assertModelData($fakeExerciseEquipment, $updatedExerciseEquipment->toArray());
        $dbExerciseEquipment = $this->exerciseEquipmentRepo->find($exerciseEquipment->id);
        $this->assertModelData($fakeExerciseEquipment, $dbExerciseEquipment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_exercise_equipment()
    {
        $exerciseEquipment = ExerciseEquipment::factory()->create();

        $resp = $this->exerciseEquipmentRepo->delete($exerciseEquipment->id);

        $this->assertTrue($resp);
        $this->assertNull(ExerciseEquipment::find($exerciseEquipment->id), 'ExerciseEquipment should not exist in DB');
    }
}
