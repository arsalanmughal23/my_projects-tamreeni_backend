<?php

namespace App\Repositories;

use App\Models\ExerciseEquipmentPivot;
use App\Repositories\BaseRepository;

/**
 * Class ExerciseEquipmentPivotRepository
 * @package App\Repositories
 * @version February 6, 2024, 9:30 am UTC
*/

class ExerciseEquipmentPivotRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'exercise_id',
        'exercise_equipment_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ExerciseEquipmentPivot::class;
    }
}
