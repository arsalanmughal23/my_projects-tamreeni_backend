<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MealBreakdown
 * @package App\Models
 * @version July 12, 2024, 9:54 am UTC
 *
 * @property string $diet_type
 * @property integer $total_calories
 * @property integer $breakfast_units
 * @property integer $lunch_units
 * @property integer $dinner_units
 * @property integer $fruit_units
 * @property integer $snack_units
 */
class MealBreakdown extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'meal_breakdowns';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'diet_type',
        'total_calories',
        'breakfast_units',
        'lunch_units',
        'dinner_units',
        'fruit_units',
        'snack_units'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diet_type' => 'string',
        'total_calories' => 'integer',
        'breakfast_units' => 'integer',
        'lunch_units' => 'integer',
        'dinner_units' => 'integer',
        'fruit_units' => 'integer',
        'snack_units' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diet_type' => 'required|string|in:traditional,keto,0,1',
        'total_calories' => ['required', 'integer'],
        'breakfast_units' => 'required',
        'lunch_units' => 'required',
        'dinner_units' => 'required',
        'fruit_units' => 'required',
        'snack_units' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
