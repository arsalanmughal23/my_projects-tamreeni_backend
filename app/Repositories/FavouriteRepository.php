<?php

namespace App\Repositories;

use App\Models\Favourite;
use DB;
use App\Repositories\BaseRepository;

/**
 * Class FavouriteRepository
 * @package App\Repositories
 * @version January 30, 2024, 2:44 pm UTC
*/

class FavouriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'instance_id',
        'instance_type'
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
        return Favourite::class;
    }

    public function favQuery($user_id)
    {
        return Favourite::where('user_id', $user_id)
        ->leftJoin('meals', function ($join) {
            $join->on('favourites.instance_id', '=', 'meals.id')
                ->where('favourites.instance_type', '=', 'meal');
        })
        ->select('favourites.*', 'meals.*');
    }
}
