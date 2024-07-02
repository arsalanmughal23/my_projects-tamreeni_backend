<?php

namespace App\Repositories;

use App\Models\QuestionAnswerAttempt;
use App\Repositories\BaseRepository;

/**
 * Class QuestionAnswerAttemptRepository
 * @package App\Repositories
 * @version July 2, 2024, 1:44 pm UTC
*/

class QuestionAnswerAttemptRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'dob',
        'age',
        'gender',
        'language',
        'goal',
        'workout_days_in_a_week',
        'how_long_time_to_workout',
        'workout_duration_per_day',
        'equipment_type',
        'height_in_cm',
        'height',
        'height_unit',
        'current_weight_in_kg',
        'current_weight',
        'current_weight_unit',
        'target_weight_in_kg',
        'target_weight',
        'target_weight_unit',
        'reach_goal_target_date',
        'body_parts',
        'physically_active',
        'level',
        'squat__one_rep_max_in_kg',
        'deadlift__one_rep_max_in_kg',
        'bench__one_rep_max_in_kg',
        'overhead__one_rep_max_in_kg',
        'health_status',
        'daily_steps_taken',
        'diet_type',
        'food_preferences',
        'calories',
        'algo_required_calories',
        'bmi',
        'status',
        'workout_plan_id',
        'nutrition_plan_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionAnswerAttempt::class;
    }
}
