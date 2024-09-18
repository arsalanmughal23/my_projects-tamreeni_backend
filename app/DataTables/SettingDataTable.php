<?php

namespace App\DataTables;

use App\Models\Setting;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SettingDataTable extends DataTable
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
        $dataTable->editColumn('service_fee', function(Setting $model){
            return ($model->service_fee ?? 0).' SAR';
        });
        $dataTable->editColumn('coach_fee', function(Setting $model){
            return ($model->coach_fee ?? 0).' SAR';
        });
        $dataTable->editColumn('dietitian_fee', function(Setting $model){
            return ($model->dietitian_fee ?? 0).' SAR';
        });
        $dataTable->editColumn('therapist_fee', function(Setting $model){
            return ($model->therapist_fee ?? 0).' SAR';
        });
        return $dataTable->addColumn('action', 'settings.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
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
            // 'title',
            // 'welcome_title',
            // 'url',
            // 'logo',
            // 'email',
            // 'contact_number',
            // 'language'
            'service_fee',
            'coach_fee',
            'dietitian_fee',
            'therapist_fee',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'settings_datatable_' . time();
    }
}
