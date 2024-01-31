<?php

namespace App\Repositories;

use App\Models\Meal;
use App\Repositories\BaseRepository;

/**
 * Class MealRepository
 * @package App\Repositories
 * @version January 30, 2024, 3:05 pm UTC
*/

class MealRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
        'meal_category_id',
        'name',
        'image',
        'calories',
        'description'
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
        return Meal::class;
    }
}
