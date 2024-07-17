<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\BaseRepository;

/**
 * Class RecipeRepository
 * @package App\Repositories
 * @version July 17, 2024, 4:13 am UTC
*/

class RecipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
        'title',
        'description',
        'image',
        'instruction',
        'units_in_recipe',
        'divide_recipe_by',
        'number_of_units',
        'calories',
        'carbs',
        'fats',
        'protein'
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
        return Recipe::class;
    }

    public function getRecipeSelectOptions() 
    {
        return $this->model()::pluck('title', 'id');
    }
}
