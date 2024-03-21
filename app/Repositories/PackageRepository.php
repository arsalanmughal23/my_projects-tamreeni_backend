<?php

namespace App\Repositories;

use App\Models\Package;
use App\Repositories\BaseRepository;

/**
 * Class PackageRepository
 * @package App\Repositories
 * @version March 21, 2024, 5:52 pm UTC
*/

class PackageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'currency',
        'amount',
        'sessions',
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
        return Package::class;
    }

    public function getPackages($params = []){

        $query = Package::query();

        if (isset($parameters['status'])) {
            $query->where('status', $params['status']);
        }

        if(isset($params['order']) && isset($params['order_by'])){
            $query->orderBy($params['order'], $params['order_by']);
        }

        return $query;
    }
}
