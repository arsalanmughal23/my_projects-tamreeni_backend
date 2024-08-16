<?php

namespace App\DataTables;

use App\Models\UserDetail;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDetailDataTable extends DataTable
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

        $dataTable->editColumn('user_id', function(UserDetail $model){
            return '<a href="'.route('users.show', $model->user_id).'">'.$model->user->name.'</a>';
        });
        $dataTable->editColumn('is_social_login', function(UserDetail $model){
            return $model->is_social_login ? 'Yes' : 'No';
        });
        $dataTable->editColumn('push_notification', function(UserDetail $model){
            return $model->push_notification ? 'On' : 'Off';
        });

        return $dataTable->addColumn('action', 'user_details.datatables_actions')
                ->rawColumns(['user_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDetail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserDetail $model)
    {
        return $model->newQuery();
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
            'user_id' => [ 'title' => 'User' ],
            // 'first_name',
            // 'last_name',
            // 'address',
            // 'phone_number',
            // 'dob',
            // 'image',
            // 'language',
            'is_social_login',
            'push_notification',
            'gender',
            'bmi',
            // 'current_weight_in_kg',
            // 'target_weight_in_kg',
            // 'height_in_cm'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'user_details_datatable_' . time();
    }
}
