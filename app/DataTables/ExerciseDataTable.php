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
            'user_id'      => ['title' => 'User', 'searchable' => false],
            'body_part_id' => ['title' => 'Body Part', 'searchable' => false],
            'name',
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
