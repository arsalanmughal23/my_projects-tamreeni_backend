<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ExerciseBreakdown
 * @package App\Models
 * @version October 9, 2024, 8:39 am UTC
 *
 * @property string $goal
 * @property string $how_long_time_to_workout
 * @property string $exercise_category
 * @property integer $exercise_count
 * @property string $sets
 * @property string $reps
 * @property string $time
 */
class ExerciseBreakdown extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'exercise_breakdowns';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'goal',
        'how_long_time_to_workout',
        'exercise_category',
        'exercise_count',
        'sets',
        'reps',
        'time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'goal' => 'string',
        'how_long_time_to_workout' => 'string',
        'exercise_category' => 'string',
        'exercise_count' => 'integer',
        'sets' => 'string',
        'reps' => 'string',
        'time' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'goal' => 'required|string',
        'how_long_time_to_workout' => 'required|string',
        'exercise_category' => 'required|string',
        'exercise_count' => 'required',
        'sets' => 'nullable|string|max:191',
        'reps' => 'nullable|string|max:191',
        'time' => 'nullable|string|max:191',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
