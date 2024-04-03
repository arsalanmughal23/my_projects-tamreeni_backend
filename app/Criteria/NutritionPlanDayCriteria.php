<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NutritionPlanDayCriteria.
 *
 * @package namespace App\Criteria;
 */
class NutritionPlanDayCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $nutrition_plan_id = null;

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('nutrition_plan_id')) {
            $model = $model->where('nutrition_plan_id', $this->nutrition_plan_id);
        }
        return $model;
    }
}
