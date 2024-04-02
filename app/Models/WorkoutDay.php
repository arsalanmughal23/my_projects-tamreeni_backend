<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class WorkoutDay
 * @package App\Models
 * @version April 1, 2024, 8:01 am UTC
 *
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $workoutDayExercises
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property integer $duration
 * @property integer $status
 */
class WorkoutDay extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'workout_days';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 10;
    const STATUS_COMPLETED   = 30;

    const DESCRIPTION = "To achieve your fitness goals, incorporate the following exercises into your routine: strength training for muscle development, cardiovascular activities for endurance and calorie burning, flexibility exercises for mobility, and core workouts for stability. Consistency and proper form are key for optimal results. Get started today!";

    protected $dates = ['deleted_at'];

    public $appends = ['body_parts', 'equipments'];

    public $fillable = [
        'workout_plan_id',
        'name',
        'description',
        'duration',
        'date',
        'image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'duration'    => 'integer',
        'status'      => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'     => 'required',
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration'    => 'required|integer',
        'status'      => 'required|integer',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable'
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
    public function workoutDayExercises()
    {
        return $this->hasMany(\App\Models\WorkoutDayExercise::class, 'workout_day_id')->with('exercise');
    }

    public function getBodyPartsAttribute()
    {
        $exercises = $this->workoutDayExercises()->get();
        return $exercises->pluck('exercise')->pluck('bodyPart')->pluck('name')->toArray();
    }

    public function getEquipmentsAttribute()
    {
        $exercises       = $this->workoutDayExercises()->get()->pluck('exercise')->pluck('id')->toArray();
        $equipmentsPivot = ExerciseEquipmentPivot::whereIn('exercise_id', $exercises)->with('exerciseEquipment')->pluck('exercise_equipment_id')->unique();
        $equipments      = ExerciseEquipment::whereIn('id', $equipmentsPivot)->pluck('name')->toArray();

        return $equipments;
    }
}
