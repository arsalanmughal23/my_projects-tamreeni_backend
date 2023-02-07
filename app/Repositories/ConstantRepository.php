<?php

namespace App\Repositories;

use App\Models\Constant;
use App\Repositories\BaseRepository;

/**
 * Class ConstantRepository
 * @package App\Repositories
 * @version February 7, 2023, 10:10 am UTC
*/

class ConstantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'instance_type',
        'text',
        'value'
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
        return Constant::class;
    }
}
