<?php

namespace App\DataTables;

use App\Models\ExerciseEquipment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ExerciseEquipmentDataTable extends DataTable
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

        $dataTable->editColumn('name', function (ExerciseEquipment $model) {
            return ($model->name) ? $model->name : "";
        });

        $dataTable->editColumn('type_slug', function (ExerciseEquipment $model) {
            return $model->type;
        });

        $dataTable->editColumn('created_at', function (ExerciseEquipment $model) {
            return $model->created_at->format('Y-m-d H:i:s');
        });

        return $dataTable->addColumn('action', 'exercise_equipments.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExerciseEquipment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExerciseEquipment $model)
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
            'type_slug' => [ 'data' => 'type_slug', 'name' => 'type_slug', 'title' => 'Type' ],
            'created_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'exercise_equipments_datatable_' . time();
    }
}
