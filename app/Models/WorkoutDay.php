<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

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
 * @property boolean $is_rest_day
 * @property integer $day_number
 * @property integer $week_number
 * @property integer $week_day_number
 */
class WorkoutDay extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;

    public $table = 'workout_days';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 20;
    const STATUS_COMPLETED   = 30;

    public $translatable = ['name', 'description'];

    const DESCRIPTION_EN = "To achieve your fitness goals, incorporate the following exercises into your routine: strength training for muscle development, cardiovascular activities for endurance and calorie burning, flexibility exercises for mobility, and core workouts for stability. Consistency and proper form are key for optimal results. Get started today!";

    const DESCRIPTION_AR = " الخاصة بك، قم بدمج التمارين التالية في روتينك: تدريب القوة لتنمية العضلات، وأنشطة القلب والأوعية الدموية للقدرة على التحمل وحرق السعرات الحرارية، وتمارين المرونة للتنقل، والتمارين الأساسية لتحقيق الاستقرار. الاتساق والشكل المناسب هما المفتاح للحصول على أفضل النتائج. ابدأ اليوم!";

    protected $dates = ['deleted_at'];

    // public $appends = ['body_parts', 'equipments', 'equipment_types'];
    public $appends = ['body_parts', 'equipments'];

    public $fillable = [
        'workout_plan_id',
        'day_number',
        'week_number',
        'week_day_number',
        'name',
        'description',
        'duration',
        'date',
        'image',
        'is_rest_day',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'day_number'        =>'integer',
        'week_number'       =>'integer',
        'week_day_number'   =>'integer',
        'user_id'     => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'duration'    => 'integer',
        'is_rest_day' => 'boolean',
        'status'      => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules        = [
        'user_id'     => 'required',
        'day_number'        =>'required|integer',
        'week_number'       =>'required|integer',
        'week_day_number'   =>'required|integer',
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration'    => 'required|integer',
        'is_rest_day' => 'sometimes|boolean',
        'status'      => 'required|integer',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable'
    ];
    public static $update_rules = [
        'status' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->workoutPlan?->user ?? null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function workoutPlan()
    {
        return $this->belongsTo(\App\Models\WorkoutPlan::class, 'workout_plan_id');
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
        return $this->workoutDayExercises->pluck('bodyPart')->pluck('name')->unique('name')->toArray();
    }

    public function getEquipmentsAttribute()
    {
        /* TODO: need to improve this code */
        $exercises       = $this->workoutDayExercises()->get()->pluck('exercise')->pluck('id')->toArray();
        $equipmentsPivot = ExerciseEquipmentPivot::whereIn('exercise_id', $exercises)->with('exerciseEquipment')->pluck('exercise_equipment_id')->unique();
        $equipments      = ExerciseEquipment::whereIn('id', $equipmentsPivot)->pluck('name')->toArray();

        return $equipments;
    }


    // public function getEquipmentTypesAttribute()
    // {
    //     /* TODO: need to improve this code */
    //     $exercises       = $this->workoutDayExercises()->get()->pluck('exercise')->pluck('id')->toArray();
    //     $equipmentsPivot = ExerciseEquipmentPivot::whereIn('exercise_id', $exercises)->with('exerciseEquipment')->pluck('exercise_equipment_id')->unique();
    //     $equipmentTypes  = ExerciseEquipment::whereIn('id', $equipmentsPivot)->pluck('type_slug')->toArray();

    //     return $equipmentTypes;
    // }
}
