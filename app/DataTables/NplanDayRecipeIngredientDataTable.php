<?php

namespace App\DataTables;

use App\Models\NplanDayRecipeIngredient;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class NplanDayRecipeIngredientDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'nplan_day_recipe_ingredients.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\NplanDayRecipeIngredient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NplanDayRecipeIngredient $model)
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
            // 'nplan_day_recipe_id',
            'type',
            'name',
            'quantity',
            'unit',
            'scaled_quantity',
            'scaled_unit'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'nplan_day_recipe_ingredients_datatable_' . time();
    }
}
