<?php

namespace App\DataTables;

use App\Models\Recipe;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RecipeDataTable extends DataTable
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

        $dataTable->editColumn('title', function(Recipe $model) {
            return $model->getTranslation('title', 'en') ?? '';
        });

        $dataTable->editColumn('meal_type_id', function(Recipe $model) {
            return $model->mealType?->slug ?? '';
        });

        $dataTable->editColumn('image', function(Recipe $model) {
            return ($model->image) ? '<img src="'.$model->image.'" height="40" />' : '';
        });
        // $dataTable->editColumn('description', function(Recipe $model) {
        //     return ($model->description) ? $model->description['en'] : '';
        // });
        // $dataTable->editColumn('instruction', function(Recipe $model) {
        //     return ($model->instruction) ? $model->instruction['en'] : '';
        // });
        return $dataTable->addColumn('action', 'recipes.datatables_actions')
                    ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Recipe $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recipe $model)
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
            'meal_type_id' => ['title' => 'Meal Type'],
            'diet_type',
            'calories',
            'title',
            // 'units_in_recipe',
            // 'divide_recipe_by',
            // 'number_of_units',
            // 'description',
            // 'instruction',
            // 'image',
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
        return 'recipes_datatable_' . time();
    }
}
