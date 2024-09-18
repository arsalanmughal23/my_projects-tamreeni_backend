<?php

namespace App\DataTables;

use App\Models\Slot;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SlotDataTable extends DataTable
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

        $dataTable->editColumn('user_id', function (Slot $model) {
            return ($model->user) ? $model->user?->name : "N/A";
        });

        $dataTable->editColumn('type', function(Slot $model) {
            return $model->type_text;
        });

        $dataTable->editColumn('created_at', function (Slot $model) {
            return $model->created_at?->format('Y-m-d H:i:s') ?? 'N/A';
        });

        return $dataTable->addColumn('action', 'slots.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slot $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slot $model)
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
            'user_id' => ['title' => 'User'],
            'day',
            'type',
            'start_time',
            'end_time',
            // 'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'slots_datatable_' . time();
    }
}
