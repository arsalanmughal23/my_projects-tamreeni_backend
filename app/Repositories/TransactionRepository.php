<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version March 21, 2024, 5:52 pm UTC
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'package_id',
        'transaction_id',
        'data',
        'currency',
        'amount',
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
        return Transaction::class;
    }

    public function index(Request $request, $params = [])
    {
        $model = $this->model()::query();

        $perPage            = $request->input('per_page', config('constants.PER_PAGE', 10));        
        $orderableColumns   = ['id','created_at'];

        if(count($params) > 0)
            $model = $model->where($params);

        if ($request->has('order')){
            $orderBy = $request->order_by;
            $orderBy == 'asc' ?: $orderBy = 'desc';
            $orderColumn = in_array($request->order, $orderableColumns) ? $request->order : $orderableColumns[0];

            $model = $model->orderBy($orderColumn, $orderBy);
        }

        if ($request->get('paginate')) {
            $model = $model->paginate($perPage);
        } else {
            $model = $model->get();
        }

        return $model;
    }
}
