<?php

namespace App\DataTables;

use App\Models\NutritionPlanDayRecipe;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class NutritionPlanDayRecipeDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'nutrition_plan_day_recipes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\NutritionPlanDayRecipe $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NutritionPlanDayRecipe $model)
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
            'diet_type',
            'nutrition_plan_day_id',
            'meal_type_id',
            'recipe_id',
            'meal_category_ids',
            'title',
            'description',
            'image',
            'instruction',
            'units_in_recipe',
            'divide_recipe_by',
            'number_of_units',
            'calories',
            'carbs',
            'fats',
            'protein'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'nutrition_plan_day_recipes_datatable_' . time();
    }
}
