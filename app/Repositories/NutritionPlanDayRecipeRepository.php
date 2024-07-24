<?php

namespace App\Repositories;

use App\Models\NutritionPlanDayRecipe;
use App\Repositories\BaseRepository;

/**
 * Class NutritionPlanDayRecipeRepository
 * @package App\Repositories
 * @version July 18, 2024, 6:36 pm UTC
*/

class NutritionPlanDayRecipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
        'nutrition_plan_day_id',
        'meal_type_id',
        'recipe_id',
        'meal_category_ids',
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
        return NutritionPlanDayRecipe::class;
    }

    public function all($params = [])
    {
        return NutritionPlanDayRecipe::with('nPlanDayRecipeIngredients')->where($params)->get();
    }
}
