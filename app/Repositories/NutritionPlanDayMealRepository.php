<?php

namespace App\Repositories;

use App\Models\NutritionPlanDayMeal;
use App\Repositories\BaseRepository;

/**
 * Class NutritionPlanDayMealRepository
 * @package App\Repositories
 * @version April 3, 2024, 9:53 am UTC
*/

class NutritionPlanDayMealRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nutrition_plan_day_id',
        'meal_id',
        'meal_category_id',
        'name',
        'diet_type',
        'calories',
        'carbs',
        'fats',
        'protein',
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
        return NutritionPlanDayMeal::class;
    }
}
