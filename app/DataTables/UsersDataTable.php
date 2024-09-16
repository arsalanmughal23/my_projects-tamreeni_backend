<?php

namespace App\DataTables;

use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query     = $query->orderBy('created_at', 'desc');
        $dataTable = new EloquentDataTable($query);

        $dataTable->addColumn('name', function ($user) {
            return $user->name ?? "N/A";
        });
        $dataTable->rawColumns(['action']);

        return $dataTable->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $model = $model->newQuery()->whereNotIn('id', [1, Auth::user()->id]);

        $selectedRole = $this->request->userRole;
        if($selectedRole == 'Mentor')
            $selectedRole = Role::MENTOR;

        if($selectedRole)
            $model = $model->role($selectedRole);

        return $model;
        // return $model->with('user_details')->select('users.*')->newQuery();
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
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',
                    // ],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',
                    ],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',
                    ],
                    // ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',
                    ],
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
            [
                'data'  => 'name',
                'title' => 'Name',
            ],
            [
                'data'  => 'email',
                'title' => 'Email',
            ],
            // [
            //     'data' => 'user_details',
            //     'title' => 'Description',
            //     'name' => 'user_details.description',
            //     'searchable' => true,
            //     'orderable' => true,
            // ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users_datatable_' . time();
    }
}
