<?php

namespace App\DataTables;

use App\Models\WellnessTip;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class WellnessTipDataTable extends DataTable
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

        $dataTable->editColumn('title', function(WellnessTip $wellnessTip) {
            return $wellnessTip->getTranslation('title', 'en') ?? '';
        });

        $dataTable->editColumn('content', function(WellnessTip $wellnessTip) {
            return $wellnessTip->getTranslation('content', 'en') ?? '';
        });

        $dataTable->editColumn('cover', function(WellnessTip $wellnessTip) {
            return '<img src="'.$wellnessTip->cover.'" alt="" height="50">';
        });

        return $dataTable->addColumn('action', 'wellness_tips.datatables_actions')
                    ->rawColumns(['cover', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\WellnessTip $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WellnessTip $model)
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
            'title',
            'content',
            'cover'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'wellness_tips_datatable_' . time();
    }
}
