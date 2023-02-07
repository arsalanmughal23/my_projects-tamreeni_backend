<?php

namespace App\Repositories;

use App\Models\Stack;
use App\Repositories\BaseRepository;

/**
 * Class StackRepository
 * @package App\Repositories
 * @version February 7, 2023, 10:11 am UTC
*/

class StackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Stack::class;
    }
}
