<?php

namespace App\Repositories;

use App\Models\WorkoutDay;
use App\Repositories\BaseRepository;

/**
 * Class WorkoutDayRepository
 * @package App\Repositories
 * @version April 1, 2024, 8:01 am UTC
*/

class WorkoutDayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'description',
        'duration',
        'status'
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
        return WorkoutDay::class;
    }
}
