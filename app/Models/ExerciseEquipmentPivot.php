<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ExerciseEquipmentPivot
 * @package App\Models
 * @version February 6, 2024, 9:30 am UTC
 *
 * @property \App\Models\ExerciseEquipment $exerciseEquipment
 * @property \App\Models\Exercise $exercise
 * @property integer $exercise_id
 * @property integer $exercise_equipment_id
 */
class ExerciseEquipmentPivot extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'exercise_equipment_pivots';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'exercise_id',
        'exercise_equipment_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'exercise_id' => 'integer',
        'exercise_equipment_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'exercise_id' => 'required|integer',
        'exercise_equipment_id' => 'required|integer',
        'created_at' => 'nullable',
        'deleted_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function exerciseEquipment()
    {
        return $this->belongsTo(\App\Models\ExerciseEquipment::class, 'exercise_equipment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function exercise()
    {
        return $this->belongsTo(\App\Models\Exercise::class, 'exercise_id');
    }
}
