<?php

namespace App\DataTables;

use App\Models\MealType;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Helper\Util;

class MealTypeDataTable extends DataTable
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

        $dataTable->editColumn('name', function (MealType $model) {
            return ($model->name) ? $model->name : "";
        });

        $dataTable->editColumn('status', function (MealType $model) {
            return '<span class="label label-' . Util::getBoolCss($model->status) . '">' . Util::getBoolText($model->status) . '</span>';
        });

        $dataTable->editColumn('created_at', function (MealType $model) {
            return ($model->created_at !== null) ? $model->created_at ?->format('Y-m-d H:i:s'):"N/A";
        });

        $dataTable->rawColumns(['status', 'action']);

        return $dataTable->addColumn('action', 'meal_types.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MealType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MealType $model)
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
            'name',
            'created_at',
            // 'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'meal_types_datatable_' . time();
    }
}
