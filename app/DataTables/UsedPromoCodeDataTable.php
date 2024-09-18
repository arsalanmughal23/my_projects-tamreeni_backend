<?php

namespace App\DataTables;

use App\Models\UsedPromoCode;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UsedPromoCodeDataTable extends DataTable
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

        $dataTable->addColumn('reference', function(UsedPromoCode $model){
            $title = $model->reference_item_title;
            $moduleName = $model->reference_module_name;
            $itemLink = $model->reference_item_link;

            $badge = '<span class="btn btn-sm bg-gray py-0 px-1">'.$moduleName.'</span>';
            return $badge.'<a href="'.$itemLink.'" > '. $title .'</a>';
        });

        return $dataTable->addColumn('action', 'used_promo_codes.datatables_actions')
                ->rawColumns(['reference', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UsedPromoCode $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UsedPromoCode $model)
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
            'user_id',
            'reference',
            'morphable_type',
            'morphable_id',
            'code',
            'value',
            'type'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'used_promo_codes_datatable_' . time();
    }
}
