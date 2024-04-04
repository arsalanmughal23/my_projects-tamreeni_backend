<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class WorkoutDayCriteria.
 *
 * @package namespace App\Criteria;
 */
class WorkoutDayCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $workout_plan_id = null;

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('workout_plan_id')) {
            $model = $model->where('workout_plan_id', $this->workout_plan_id);
        }
        return $model;
    }
}
