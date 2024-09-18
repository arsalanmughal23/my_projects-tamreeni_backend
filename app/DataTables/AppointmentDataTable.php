<?php

namespace App\DataTables;

use App\Models\Appointment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AppointmentDataTable extends DataTable
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
        $dataTable->editColumn('customer_id', function(Appointment $model){
            return '<a href="'.route('users.show', $model->customer_id).'">'.$model->customer->name.'</a>';
        });
        $dataTable->editColumn('user_id', function(Appointment $model){
            return '<a href="'.route('users.show', $model->user_id).'">'.$model->user->name.'</a>';
        });
        $dataTable->editColumn('status', function(Appointment $model){
            return $model->status_label ?? null;
        });
        $dataTable->editColumn('type', function(Appointment $model){
            return $model->type_label ?? null;
        });
        $dataTable->editColumn('profession_type', function(Appointment $model){
            return $model->profession_type_label ?? null;
        });
        return $dataTable->addColumn('action', 'appointments.datatables_actions')
                        ->rawColumns(['customer_id', 'user_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Appointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appointment $model)
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
                    [
                        'extend' => 'csv',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-file-csv"></i> CSV'
                    ],
                    [
                        'extend' => 'excel',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-file-excel"></i> Excel'
                    ],
                    [
                        'extend' => 'print',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-print"></i> Print'
                    ],
                    [
                        'extend' => 'reload',
                        'className' => 'btn btn-default btn-sm no-corner',
                        'text' => '<i class="fa fa-sync"></i> Reload'
                    ],
                ]
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
            'customer_id' => ['title' => 'Customer'],
            'user_id' => ['title' => 'User'],
            // 'slot_id',
            // 'package_id',
            // 'transaction_id',
            'date',
            'start_time',
            'end_time',
            'type',
            'profession_type',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'appointments_datatable_' . time();
    }
}
