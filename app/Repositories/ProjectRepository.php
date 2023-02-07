<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\BaseRepository;

/**
 * Class ProjectRepository
 * @package App\Repositories
 * @version February 7, 2023, 1:35 pm UTC
*/

class ProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'start_date',
        'end_date',
        'project_manager_id',
        'business_analyst_id',
        'active'
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
        return Project::class;
    }
}
