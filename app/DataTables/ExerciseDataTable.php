<?php

namespace App\DataTables;

use App\Models\Exercise;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ExerciseDataTable extends DataTable
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

        $dataTable->editColumn('user_id', function (Exercise $model) {
            return ($model->user) ? $model ?->user ?->name : "N/A";
        });

        $dataTable->editColumn('body_part_id', function (Exercise $model) {
            return ($model->bodyPart) ? $model->bodyPart ?->name : "N/A";
        });

        $dataTable->editColumn('name', function (Exercise $model) {
            return ($model->name) ? $model->name : "";
        });

        $dataTable->editColumn('exercise_category_name', function (Exercise $model) {
            return $model->category_name ?? "N/A";
        });
        $dataTable->editColumn('exercise_type_name', function (Exercise $model) {
            return $model->type_name ?? "N/A";
        });

        $dataTable->editColumn('created_at', function (Exercise $model) {
            return $model->created_at->format('Y-m-d H:i:s');
        });

        return $dataTable->addColumn('action', 'exercises.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Exercise $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Exercise $model)
    {
        if ($this->request->body_part) {
            return $model
                ->newQuery()->where('body_part_id', $this->request->body_part);
        }

        if ($this->request->equipment) {
            $equipmentId = $this->request->equipment;
            return $model
                ->newQuery()->whereHas('equipment', function ($query) use ($equipmentId) {
                        $query->where('exercise_equipment_id', $equipmentId);
                    });
        }

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
            'user_id'      => ['title' => 'User', 'searchable' => false],
            'body_part_id' => ['title' => 'Body Part', 'searchable' => false],
            'name',
            'exercise_category_name'=> ['title' => 'Category Name', 'searchable' => true],
            'exercise_type_name'=> ['title' => 'Type Name', 'searchable' => true],
            'sets',
            'reps',
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
        return 'exercises_datatable_' . time();
    }
}
