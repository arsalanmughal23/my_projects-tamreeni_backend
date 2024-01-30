<?php

namespace App\Repositories;

use App\Models\Constant;
use App\Repositories\BaseRepository;

/**
 * Class ConstantRepository
 * @package App\Repositories
 * @version January 29, 2024, 2:22 pm UTC
*/

class ConstantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'group',
        'key',
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

    public function getConstantsByGroup($group)
    {
        return Constant::where('group', $group)->get();
    }
}
