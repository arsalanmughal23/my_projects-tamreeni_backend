<?php

namespace App\DataTables;

use App\Models\Event;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EventDataTable extends DataTable
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

        $dataTable->editColumn('user_id', function(Event $model) {
            return $model->user?->name ?? '';
        });
        $dataTable->editColumn('body_part_id', function(Event $model) {
            return $model->bodyPart?->name ?? '';
        });
        $dataTable->editColumn('equipment_id', function(Event $model) {
            return $model->equipment?->name ?? '';
        });

        $dataTable->editColumn('duration', function(Event $model) {
            return ($model->duration ?? 0) . ' m';
        });

        $dataTable->editColumn('title', function(Event $model) {
            return $model->title;
        });

        $dataTable->editColumn('description', function(Event $model) {
            return $model->description;
        });

        return $dataTable->addColumn('action', 'events.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Event $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Event $model)
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
            'date',
            'start_time',
            'end_time',
            'duration',
            // 'description',
            // 'image',
            'user_id' => [ 'title' => 'User' ],
            'body_part_id' => [ 'title' => 'Body Part' ],
            'equipment_id' => [ 'title' => 'Equipment' ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'events_datatable_' . time();
    }
}
