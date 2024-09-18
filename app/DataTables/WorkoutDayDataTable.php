<?php

namespace App\DataTables;

use App\Models\WorkoutDay;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class WorkoutDayDataTable extends DataTable
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

        $dataTable->editColumn('name', function(WorkoutDay $workoutDay) {
            return $workoutDay->getTranslation('name', 'en');
        });

        $dataTable->editColumn('description', function(WorkoutDay $workoutDay) {
            return $workoutDay->getTranslation('description', 'en');
        });

        return $dataTable->addColumn('action', 'workout_days.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\WorkoutDay $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WorkoutDay $model)
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
            // 'user_id',
            // 'description',
            'name',
            'duration',
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
        return 'workout_days_datatable_' . time();
    }
}
