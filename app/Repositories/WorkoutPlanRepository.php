<?php

namespace App\Repositories;

use App\Models\WorkoutPlan;
use App\Repositories\BaseRepository;

/**
 * Class WorkoutPlanRepository
 * @package App\Repositories
 * @version April 2, 2024, 8:09 am UTC
*/

class WorkoutPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
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
        return WorkoutPlan::class;
    }
}
