<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class QuestionAnswerAttempt
 * @package App\Models
 * @version July 2, 2024, 1:44 pm UTC
 *
 * @property \App\Models\NutritionPlan $nutritionPlan
 * @property \App\Models\User $user
 * @property \App\Models\WorkoutPlan $workoutPlan
 * @property integer $user_id
 * @property string $dob
 * @property integer $age
 * @property string $gender
 * @property string $language
 * @property string $goal
 * @property string $workout_days_in_a_week
 * @property string $how_long_time_to_workout
 * @property string $workout_duration_per_day
 * @property string $equipment_type
 * @property number $height_in_cm
 * @property number $height
 * @property string $height_unit
 * @property number $current_weight_in_kg
 * @property number $current_weight
 * @property string $current_weight_unit
 * @property number $target_weight_in_kg
 * @property number $target_weight
 * @property string $target_weight_unit
 * @property string $reach_goal_target_date
 * @property string $body_parts
 * @property string $physically_active
 * @property string $level
 * @property number $squat__one_rep_max_in_kg
 * @property number $deadlift__one_rep_max_in_kg
 * @property number $bench__one_rep_max_in_kg
 * @property number $overhead__one_rep_max_in_kg
 * @property string $health_status
 * @property string $daily_steps_taken
 * @property string $diet_type
 * @property string $food_preferences
 * @property number $calories
 * @property number $algo_required_calories
 * @property number $bmi
 * @property string $status
 * @property integer $workout_plan_id
 * @property integer $nutrition_plan_id
 */
class QuestionAnswerAttempt extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'question_answer_attempts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_CANCEL = 'cancel';
    const STATUS_TERMINATE = 'terminate';


    protected $dates = ['deleted_at'];
    
    public $appends = ['status_class'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'dob' => 'date',
        'age' => 'integer',
        'gender' => 'string',
        'language' => 'string',
        'goal' => 'string',
        'workout_days_in_a_week' => 'string',
        'how_long_time_to_workout' => 'string',
        'workout_duration_per_day' => 'string',
        'equipment_type' => 'string',
        'height_in_cm' => 'float',
        'height' => 'float',
        'height_unit' => 'string',
        'current_weight_in_kg' => 'float',
        'current_weight' => 'float',
        'current_weight_unit' => 'string',
        'target_weight_in_kg' => 'float',
        'target_weight' => 'float',
        'target_weight_unit' => 'string',
        'reach_goal_target_date' => 'date',
        'body_parts' => 'json',
        'physically_active' => 'string',
        'level' => 'string',
        'squat__one_rep_max_in_kg' => 'float',
        'deadlift__one_rep_max_in_kg' => 'float',
        'bench__one_rep_max_in_kg' => 'float',
        'overhead__one_rep_max_in_kg' => 'float',
        'health_status' => 'string',
        'daily_steps_taken' => 'string',
        'diet_type' => 'string',
        'food_preferences' => 'json',
        'calories' => 'float',
        'algo_required_calories' => 'float',
        'bmi' => 'float',
        'status' => 'string',
        'workout_plan_id' => 'integer',
        'nutrition_plan_id' => 'integer'
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'dob' => 'nullable',
        'age' => 'nullable|integer',
        'gender' => 'nullable|string',
        'language' => 'nullable|string',
        'goal' => 'nullable|string|max:191',
        'workout_days_in_a_week' => 'nullable|string|max:191',
        'how_long_time_to_workout' => 'nullable|string|max:191',
        'workout_duration_per_day' => 'nullable|string|max:191',
        'equipment_type' => 'nullable|string|max:191',
        'height_in_cm' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'height_unit' => 'nullable|string|max:191',
        'current_weight_in_kg' => 'nullable|numeric',
        'current_weight' => 'nullable|numeric',
        'current_weight_unit' => 'nullable|string|max:191',
        'target_weight_in_kg' => 'nullable|numeric',
        'target_weight' => 'nullable|numeric',
        'target_weight_unit' => 'nullable|string|max:191',
        'reach_goal_target_date' => 'nullable',
        'body_parts' => 'required|string|max:191',
        'physically_active' => 'nullable|string|max:191',
        'level' => 'nullable|string|max:191',
        'squat__one_rep_max_in_kg' => 'nullable|numeric',
        'deadlift__one_rep_max_in_kg' => 'nullable|numeric',
        'bench__one_rep_max_in_kg' => 'nullable|numeric',
        'overhead__one_rep_max_in_kg' => 'nullable|numeric',
        'health_status' => 'nullable|string|max:191',
        'daily_steps_taken' => 'nullable|string|max:191',
        'diet_type' => 'nullable|string|max:191',
        'food_preferences' => 'required|string|max:191',
        'calories' => 'required|numeric',
        'algo_required_calories' => 'required|numeric',
        'bmi' => 'required|numeric',
        'status' => 'required|string|max:191',
        'workout_plan_id' => 'nullable',
        'nutrition_plan_id' => 'nullable',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function nutritionPlan()
    {
        return $this->belongsTo(\App\Models\NutritionPlan::class, 'nutrition_plan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function workoutPlan()
    {
        return $this->belongsTo(\App\Models\WorkoutPlan::class, 'workout_plan_id');
    }

    
    public function setDobAttribute($dob)
    {
        if (isset($dob)) {
            $dob = \Carbon\Carbon::parse($dob);
            $this->attributes['dob'] = $dob;
            $this->attributes['age'] = $dob->age;
        }
    }

    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            self::STATUS_ACTIVE => 'success',
            self::STATUS_CANCEL => 'danger',
            self::STATUS_PENDING => 'warning',
            self::STATUS_TERMINATE => 'secondary',
            default => 'secondary'
        };
    }
}
