<?php

namespace App\Repositories;

use App\Models\MealBreakdown;
use App\Repositories\BaseRepository;

/**
 * Class MealBreakdownRepository
 * @package App\Repositories
 * @version July 12, 2024, 9:54 am UTC
*/

class MealBreakdownRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
        'total_calories',
        'breakfast_units',
        'lunch_units',
        'dinner_units',
        'fruit_units',
        'snack_units'
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
        return MealBreakdown::class;
    }
}
