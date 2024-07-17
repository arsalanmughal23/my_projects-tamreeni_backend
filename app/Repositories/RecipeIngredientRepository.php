<?php

namespace App\Repositories;

use App\Models\RecipeIngredient;
use App\Repositories\BaseRepository;

/**
 * Class RecipeIngredientRepository
 * @package App\Repositories
 * @version July 17, 2024, 12:44 pm UTC
*/

class RecipeIngredientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'recipe_id',
        'type',
        'name',
        'quantity',
        'unit'
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
        return RecipeIngredient::class;
    }

    public function getTypeSelectOptions()
    {
        return $this->model()::CONST_TYPES;
    }
    
    public function getUnitSelectOptions()
    {
        return $this->model()::CONST_UNITS;
    }
}
