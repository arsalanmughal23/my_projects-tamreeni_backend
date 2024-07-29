<?php

namespace App\DataTables;

use App\Models\MembershipDuration;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MembershipDurationDataTable extends DataTable
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
        $dataTable->editColumn('membership_id', function(MembershipDuration $model){
            return '<a href="'.route('memberships.show', $model->membership_id).'">'.$model->membership_id.'</a>';
        });
        $dataTable->editColumn('title', function(MembershipDuration $model){
            return $model->getTranslation('title', app()->getLocale()) ?? '';
        });
        $dataTable->editColumn('price', function(MembershipDuration $model){
            return ($model->price ?? 0) . ' SAR';
        });
        return $dataTable->addColumn('action', 'membership_durations.datatables_actions')
                ->rawColumns(['membership_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MembershipDuration $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MembershipDuration $model)
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
            'membership_id',
            'title',
            'duration_in_month',
            'price'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'membership_durations_datatable_' . time();
    }
}
