<?php namespace Tests\Repositories;

use App\Models\ExerciseEquipmentPivot;
use App\Repositories\ExerciseEquipmentPivotRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ExerciseEquipmentPivotRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExerciseEquipmentPivotRepository
     */
    protected $exerciseEquipmentPivotRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->exerciseEquipmentPivotRepo = \App::make(ExerciseEquipmentPivotRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->make()->toArray();

        $createdExerciseEquipmentPivot = $this->exerciseEquipmentPivotRepo->create($exerciseEquipmentPivot);

        $createdExerciseEquipmentPivot = $createdExerciseEquipmentPivot->toArray();
        $this->assertArrayHasKey('id', $createdExerciseEquipmentPivot);
        $this->assertNotNull($createdExerciseEquipmentPivot['id'], 'Created ExerciseEquipmentPivot must have id specified');
        $this->assertNotNull(ExerciseEquipmentPivot::find($createdExerciseEquipmentPivot['id']), 'ExerciseEquipmentPivot with given id must be in DB');
        $this->assertModelData($exerciseEquipmentPivot, $createdExerciseEquipmentPivot);
    }

    /**
     * @test read
     */
    public function test_read_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->create();

        $dbExerciseEquipmentPivot = $this->exerciseEquipmentPivotRepo->find($exerciseEquipmentPivot->id);

        $dbExerciseEquipmentPivot = $dbExerciseEquipmentPivot->toArray();
        $this->assertModelData($exerciseEquipmentPivot->toArray(), $dbExerciseEquipmentPivot);
    }

    /**
     * @test update
     */
    public function test_update_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->create();
        $fakeExerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->make()->toArray();

        $updatedExerciseEquipmentPivot = $this->exerciseEquipmentPivotRepo->update($fakeExerciseEquipmentPivot, $exerciseEquipmentPivot->id);

        $this->assertModelData($fakeExerciseEquipmentPivot, $updatedExerciseEquipmentPivot->toArray());
        $dbExerciseEquipmentPivot = $this->exerciseEquipmentPivotRepo->find($exerciseEquipmentPivot->id);
        $this->assertModelData($fakeExerciseEquipmentPivot, $dbExerciseEquipmentPivot->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_exercise_equipment_pivot()
    {
        $exerciseEquipmentPivot = ExerciseEquipmentPivot::factory()->create();

        $resp = $this->exerciseEquipmentPivotRepo->delete($exerciseEquipmentPivot->id);

        $this->assertTrue($resp);
        $this->assertNull(ExerciseEquipmentPivot::find($exerciseEquipmentPivot->id), 'ExerciseEquipmentPivot should not exist in DB');
    }
}
