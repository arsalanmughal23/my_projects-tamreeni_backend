<?php

namespace App\Repositories;

use App\Models\ExerciseEquipment;
use App\Repositories\BaseRepository;

/**
 * Class ExerciseEquipmentRepository
 * @package App\Repositories
 * @version February 5, 2024, 12:05 pm UTC
*/

class ExerciseEquipmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon'
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
        return ExerciseEquipment::class;
    }
}
