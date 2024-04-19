<?php

namespace App\Repositories;

use App\Models\NutritionPlanDay;
use App\Repositories\BaseRepository;

/**
 * Class NutritionPlanDayRepository
 * @package App\Repositories
 * @version April 3, 2024, 9:53 am UTC
*/

class NutritionPlanDayRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nutrition_plan_id',
        'name',
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
        return NutritionPlanDay::class;
    }

    public function getNutritionPlanActiveDayByDate($nutrition_plan_id, $date = null)
    {
        !$date && $date = now()->format('Y-m-d');
        return NutritionPlanDay::where('nutrition_plan_id', $nutrition_plan_id)
                    // Need to UnComment when Cron Is Applying
                    // ->where('status', NutritionPlanDay::STATUS_IN_PROGRESS)
                    ->where('date', $date)
                    ->first();
    }
}
