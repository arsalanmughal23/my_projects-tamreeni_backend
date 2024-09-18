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

        $dataTable->editColumn('title', function(NutritionPlanDayRecipe $model) {
            return $model->title ?? '';
        });
        $dataTable->editColumn('description', function(NutritionPlanDayRecipe $model) {
            return $model->description ?? '';
        });
        $dataTable->editColumn('instruction', function(NutritionPlanDayRecipe $model) {
            return $model->instruction ?? '';
        });

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
            'diet_type',
            // 'nutrition_plan_day_id',
            // 'meal_type_id',
            // 'recipe_id',
            // 'meal_category_names',
            'title',
            // 'units_in_recipe',
            // 'divide_recipe_by',
            // 'number_of_units',
            'calories',
            'carbs',
            'fats',
            'protein'
            // 'meal_category_ids',
            // 'description',
            // 'instruction',
            // 'image',
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
