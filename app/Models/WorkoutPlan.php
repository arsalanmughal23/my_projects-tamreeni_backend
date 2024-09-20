<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class WorkoutPlan
 * @package App\Models
 * @version April 2, 2024, 8:09 am UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 */
class WorkoutPlan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'workout_plans';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 20;
    const STATUS_COMPLETED   = 30;

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'user_id'    => 'integer',
        'name'       => 'string',
        'start_date' => 'date',
        'end_date'   => 'date',
        'status'     => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'    => 'required',
        'name'       => 'required|string|max:255',
        'start_date' => 'required',
        'end_date'   => 'required',
        'status'     => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function workoutPlanDays()
    {
        return $this->hasMany(\App\Models\WorkoutDay::class, 'workout_plan_id');
    }
}
