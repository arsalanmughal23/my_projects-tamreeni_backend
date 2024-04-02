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
    protected $get_dates = null;

    public function apply($model, RepositoryInterface $repository)
    {
        return $model;
    }
}
