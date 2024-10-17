<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class WorkoutDayExercise
 * @package App\Models
 * @version April 1, 2024, 8:01 am UTC
 *
 * @property \App\Models\Exercise $exercise
 * @property \App\Models\WorkoutDay $workoutDay
 * @property integer $workout_day_id
 * @property integer $exercise_id
 * @property integer $duration_in_m
 * @property string $duration
 * @property integer $sets
 * @property integer $reps
 * @property number $burn_calories
 * @property integer $status
 * @property boolean $is_finisher
 */
class WorkoutDayExercise extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'workout_day_exercises';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 20;
    const STATUS_COMPLETED   = 30;

    protected $dates = ['deleted_at'];

    public $translatable = ['name', 'description'];

    public $fillable = [
        'name',
        'description',
        'exercise_category_name',
        'exercise_type_name',
        'duration_in_m',
        'duration',
        'sets',
        'reps',
        'weight_in_kg',
        'burn_calories',
        'image',
        'audio',
        'video',
        'status',
        'body_part_id',
        'workout_day_id',
        'exercise_id',
        'is_finisher'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'workout_day_id' => 'integer',
        'exercise_id'    => 'integer',
        'duration'       => 'string',
        'sets'           => 'string',
        'reps'           => 'string',
        'burn_calories'  => 'float',
        'status'         => 'integer',
        'is_finisher'   => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'workout_day_id' => 'required',
        'exercise_id'    => 'required|integer',
        'duration'       => 'required|integer',
        'sets'           => 'required|integer',
        'reps'           => 'required|integer',
        'burn_calories'  => 'required|numeric',
        'status'         => 'required|integer',
        'created_at'     => 'nullable',
        'updated_at'     => 'nullable',
        'deleted_at'     => 'nullable',
        'is_finisher'    => 'nullable'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bodyPart()
    {
        return $this->belongsTo(BodyPart::class, 'body_part_id');
    }
}
