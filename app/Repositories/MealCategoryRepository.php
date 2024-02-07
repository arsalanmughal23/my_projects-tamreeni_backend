<?php

namespace App\Repositories;

use App\Models\MealCategory;
use App\Repositories\BaseRepository;

/**
 * Class MealCategoryRepository
 * @package App\Repositories
 * @version January 30, 2024, 3:04 pm UTC
*/

class MealCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
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
        return MealCategory::class;
    }
}
