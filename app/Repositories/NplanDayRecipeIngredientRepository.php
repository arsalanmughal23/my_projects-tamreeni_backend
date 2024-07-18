<?php

namespace App\Repositories;

use App\Models\NplanDayRecipeIngredient;
use App\Repositories\BaseRepository;

/**
 * Class NplanDayRecipeIngredientRepository
 * @package App\Repositories
 * @version July 18, 2024, 6:53 pm UTC
*/

class NplanDayRecipeIngredientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'recipe_id',
        'type',
        'name',
        'quantity',
        'unit',
        'scaled_quantity',
        'scaled_unit'
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
        return NplanDayRecipeIngredient::class;
    }
}
