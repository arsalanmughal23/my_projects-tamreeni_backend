<?php

namespace App\Repositories;

use App\Models\MealType;
use App\Repositories\BaseRepository;

/**
 * Class MealTypeRepository
 * @package App\Repositories
 * @version March 25, 2024, 9:32 am UTC
*/

class MealTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return MealType::class;
    }

    public function getMealTypes($params  = []){

        $query = MealType::query();

        if(isset($params['status'])){
            $query->where('status', $params['status']);
        }

        return $query;
    }
}
