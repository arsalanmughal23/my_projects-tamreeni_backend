<?php

namespace App\DataTables;

use App\Models\RecipeIngredient;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RecipeIngredientDataTable extends DataTable
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

        $dataTable->editColumn('recipe_id', function(RecipeIngredient $model) {
            $recipe = $model->recipe;
            return $recipe ? '<a href="'.route('recipes.show', $recipe?->id).'">#'.$recipe->id.'</a>' : '';
        });

        $dataTable->editColumn('name', function(RecipeIngredient $model) {
            return $model->getTranslation('name', 'en') ?? '';
        });

        return $dataTable->addColumn('action', 'recipe_ingredients.datatables_actions')
                ->rawColumns(['recipe_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RecipeIngredient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RecipeIngredient $model)
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
            'recipe_id',
            'type',
            'name',
            'quantity',
            'unit'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'recipe_ingredients_datatable_' . time();
    }
}
