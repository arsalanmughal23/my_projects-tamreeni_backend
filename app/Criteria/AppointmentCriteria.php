<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AppointmentCriteria.
 *
 * @package namespace App\Criteria;
 */
class AppointmentCriteria extends BaseCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */

    protected $user_id = null;
    protected $customer_id = null;
    protected $type = null;
    protected $profession_type = null;
    protected $status = null;
    protected $payment_status = null;
    protected $start_date = null;
    protected $date = null;
    protected $order_by = null;
    protected $order = null;

    private $orderableColumns = ['id','date','start_time','end_time','created_at','updated_at'];

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->isset('user_id'))
            $model = $model->where('user_id', $this->user_id);

        if ($this->isset('customer_id'))
            $model = $model->where('customer_id', $this->customer_id);

        if ($this->isset('type'))
            $model = $model->where('type', $this->type);

        if ($this->isset('profession_type'))
            $model = $model->where('profession_type', $this->profession_type);

        if ($this->isset('status'))
            $model = $model->where('status', $this->status);

        if ($this->isset('payment_status'))
            $model = $model->where('payment_status', $this->payment_status);

        if ($this->isset('start_date'))
            $model = $model->where('date', '>=', $this->start_date);

        if ($this->isset('date'))
            $model = $model->whereDate('date', $this->date);

        if ($this->isset('order')){
            $orderColumn = in_array($this->order, $this->orderableColumns) ? $this->order : $this->orderableColumns[0];
            $this->order_by == 'asc' ?: $this->order_by = 'desc';
            $model = $model->orderBy($orderColumn, $this->order_by);
        }

        return $model;
    }
}
