<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserDetail
 * @package App\Models
 * @version January 30, 2024, 1:30 pm UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $phone_number
 * @property string $dob
 * @property string $image
 * @property boolean $is_social_login
 * @property boolean $push_notification
 * @property string $gender
 * 
 * @property string $age
 * @property string $height_in_cm
 * @property string $target_weight_in_kg
 * @property string $current_weight_in_kg
 * @property string $workout_duration_per_day
 * @property string $is_last_attempt_plan_generated
 * @property string $unplaned_answer_attempt_id
 * @property string $planed_answer_attempt_id
 * 
 * @property BelongsTo $questionAnswerAttempts
 */

class UserDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_details';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $appends = ['current_workout_plan_id', 'current_nutrition_plan_id'];
    
    public $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'phone_number_country_code',
        'image',
        'is_social_login',
        'push_notification',

        'language',

        'goal',
        'gender',
        'dob',

        // 'age',
        // 'height_in_cm',
        // 'current_weight_in_kg',
        // 'target_weight_in_kg',
        'height',
        'height_unit',
        'current_weight',
        'current_weight_unit',
        'target_weight',
        'target_weight_unit',

        'workout_days_in_a_week',
        'how_long_time_to_workout',
        // 'workout_duration_per_day',
        'equipment_type',
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

        'delete_account_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                        => 'integer',
        'user_id'                   => 'integer',
        'first_name'                => 'string',
        'last_name'                 => 'string',
        'address'                   => 'string',
        'phone_number'              => 'string',
        'phone_number_country_code' => 'string',
        'dob'                       => 'date',
        'reach_goal_target_date'    => 'date',
        'image'                     => 'string',
        'is_social_login'           => 'boolean',
        'gender'                    => 'string',
        'push_notification'         => 'boolean',
        'body_parts'                => 'json',
        'food_preferences'          => 'json',
        'calories'                  => 'float',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function deleteAccountType()
    {
        return $this->hasOne(Constant::class, 'id', 'delete_account_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function questionAnswerAttempts()
    {
        return $this->belongsTo(QuestionAnswerAttempt::class, 'planed_answer_attempt_id');
    }

    public function terminateAnswerAttempts()
    {
        return $this->questionAnswerAttempts()
            ->where('status', QuestionAnswerAttempt::STATUS_ACTIVE)
            ->update(['status' => QuestionAnswerAttempt::STATUS_TERMINATE]);
    }

    public function lastAnswerAttempt($status)
    {
        return $this->questionAnswerAttempts()->where('status', $status)->orderBy('created_at', 'desc')->first();
    }

    public function currentWorkoutPlan()
    {
        return $this->questionAnswerAttempts?->workoutPlan;
    }

    public function currentNutritionPlan()
    {
        return $this->questionAnswerAttempts?->nutritionPlan;
    }

    public function getCurrentWorkoutPlanIdAttribute()
    {
        return $this->questionAnswerAttempts?->workout_plan_id;
    }

    public function getCurrentNutritionPlanIdAttribute()
    {
        return $this->questionAnswerAttempts?->nutrition_plan_id;
    }

    public function setDobAttribute($dob)
    {
        if (isset($dob)) {
            $dob = \Carbon\Carbon::parse($dob);
            $this->attributes['dob'] = $dob;
            $this->attributes['age'] = $dob->age;
        }
    }
}
