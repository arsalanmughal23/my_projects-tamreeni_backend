<?php

namespace App\DataTables;

use App\Models\QuestionAnswerAttempt;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class QuestionAnswerAttemptDataTable extends DataTable
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
        $dataTable->editColumn('user_id', function($model){
            $user = $model?->user;
            return '<a href="'.route('users.show', $user?->id).'">'.($user?->name ?? 'User').'</a>';
        });
        $dataTable->editColumn('status', function($model){
            return '<div class="btn btn-sm btn-'.$model->status_class.'">'.ucfirst($model->status).'</div>';
        });
        return $dataTable->addColumn('action', 'question_answer_attempts.datatables_actions')
            ->rawColumns(['user_id', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuestionAnswerAttempt $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QuestionAnswerAttempt $model)
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
            'user_id' => ['title' => 'User', 'searchable' => true],
            'calories' => ['title' => 'Calorie', 'searchable' => true],
            'algo_required_calories' => ['title' => 'Algo Required Calorie', 'searchable' => false],
            'bmi' => ['title' => 'BMI', 'searchable' => true],
            'status' => ['title' => 'Status', 'searchable' => true],
            'workout_plan_id',
            'nutrition_plan_id',
            // 'dob',
            // 'age',
            // 'gender',
            // 'language',
            // 'goal',
            // 'workout_days_in_a_week',
            // 'how_long_time_to_workout',
            // 'workout_duration_per_day',
            // 'equipment_type',
            // 'height_in_cm',
            // 'height',
            // 'height_unit',
            // 'current_weight_in_kg',
            // 'current_weight',
            // 'current_weight_unit',
            // 'target_weight_in_kg',
            // 'target_weight',
            // 'target_weight_unit',
            // 'reach_goal_target_date',
            // 'body_parts',
            // 'physically_active',
            // 'level',
            // 'squat__one_rep_max_in_kg',
            // 'deadlift__one_rep_max_in_kg',
            // 'bench__one_rep_max_in_kg',
            // 'overhead__one_rep_max_in_kg',
            // 'health_status',
            // 'daily_steps_taken',
            // 'diet_type',
            // 'food_preferences',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'question_answer_attempts_datatable_' . time();
    }
}
