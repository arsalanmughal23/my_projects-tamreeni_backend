<?php

namespace App\DataTables;

use App\Models\Meal;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MealDataTable extends DataTable
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

        $dataTable->editColumn('name', function (Meal $model) {
            return ($model->name) ? $model->name : "";
        });

        $dataTable->editColumn('diet_type', function (Meal $model) {
            return ($model->diet_type) ? $model->diet_type : "";
        });

        $dataTable->editColumn('meal_category', function (Meal $model) {
            return ($model->mealCategory) ? $model->mealCategory->name : "";
        });

        $dataTable->editColumn('created_at', function (Meal $model) {
            return $model->created_at->format('Y-m-d H:i:s');
        });

        return $dataTable->addColumn('action', 'meals.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Meal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Meal $model)
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
            'name',
            'calories',
            'diet_type',
            'meal_category',
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
        return 'meals_datatable_' . time();
    }
}
