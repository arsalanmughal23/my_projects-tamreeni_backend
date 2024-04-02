<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class WorkoutDayExercise
 * @package App\Models
 * @version April 1, 2024, 8:01 am UTC
 *
 * @property \App\Models\Exercise $exercise
 * @property \App\Models\WorkoutDay $workoutDay
 * @property integer $workout_day_id
 * @property integer $exercise_id
 * @property integer $duration
 * @property integer $sets
 * @property integer $reps
 * @property number $burn_calories
 * @property integer $status
 */
class WorkoutDayExercise extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'workout_day_exercises';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 10;
    const STATUS_COMPLETED   = 30;

    protected $dates = ['deleted_at'];



    public $fillable = [
        'workout_day_id',
        'exercise_id',
        'duration',
        'sets',
        'reps',
        'burn_calories',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'workout_day_id' => 'integer',
        'exercise_id' => 'integer',
        'duration' => 'integer',
        'sets' => 'integer',
        'reps' => 'integer',
        'burn_calories' => 'float',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'workout_day_id' => 'required',
        'exercise_id' => 'required|integer',
        'duration' => 'required|integer',
        'sets' => 'required|integer',
        'reps' => 'required|integer',
        'burn_calories' => 'required|numeric',
        'status' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function exercise()
    {
        return $this->belongsTo(\App\Models\Exercise::class, 'exercise_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function workoutDay()
    {
        return $this->belongsTo(\App\Models\WorkoutDay::class, 'workout_day_id');
    }
}
