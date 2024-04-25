<?php

namespace App\DataTables;

use App\Models\Transaction;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->editColumn('user_id', function (Transaction $model) {
            return ($model->user) ? $model->user ?->name : "N/A";
        });

        $dataTable->editColumn('package_id', function (Transaction $model) {
            return ($model->package) ? $model->package ?->name : "1-1 Session";
        });

//        $dataTable->filterColumn('package_name', function ($query, $keyword) {
//            $query->whereHas('package', function ($q) use ($keyword) {
//                $q->where('name', 'like', "%$keyword%");
//            });
//        });

        $dataTable->editColumn('created_at', function (Transaction $model) {
            return $model->created_at->format('Y-m-d H:i:s');
        });


        return $dataTable->addColumn('action', 'transactions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'user_id'    => ['title' => 'User', 'searchable' => false],
            'user.name'  => ['visible' => false, 'searchable' => true],
            'package_id' => ['title' => 'Package', 'searchable' => false],
            'currency',
            'amount',
            'created_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactions_datatable_' . time();
    }
}
