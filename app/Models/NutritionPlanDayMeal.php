<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class NutritionPlanDayMeal
 * @package App\Models
 * @version April 3, 2024, 9:53 am UTC
 *
 * @property \App\Models\MealCategory $mealCategory
 * @property \App\Models\Meal $meal
 * @property \App\Models\NutritionPlanDay $nutritionPlanDay
 * @property integer $nutrition_plan_day_id
 * @property integer $meal_id
 * @property integer $meal_category_id
 * @property string $name
 * @property string $diet_type
 * @property number $calories
 * @property number $carbs
 * @property number $fats
 * @property number $protein
 * @property integer $status
 */
class NutritionPlanDayMeal extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;
    public $table        = 'nutrition_plan_day_meals';
    public $translatable = ['name', 'diet_type'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 20;
    const STATUS_COMPLETED   = 30;

    protected $dates = ['deleted_at'];

    protected $appends = [];

    public $fillable = [
        'nutrition_plan_day_id',
        'meal_id',
        'meal_type_id',
        'meal_category_id',
        'name',
        'description',
        'diet_type',
        'image',
        'calories',
        'carbs',
        'fats',
        'protein',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                    => 'integer',
        'nutrition_plan_day_id' => 'integer',
        'meal_id'               => 'integer',
        'meal_type_id'          => 'integer',
        'name'                  => 'string',
        'calories'              => 'float',
        'carbs'                 => 'float',
        'fats'                  => 'float',
        'protein'               => 'float',
        'status'                => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nutrition_plan_day_id' => 'required',
        'meal_id'               => 'nullable|integer',
        'meal_type_id'          => 'required|integer',
        'name'                  => 'required|string|max:191',
        'calories'              => 'required|numeric',
        'carbs'                 => 'required|numeric',
        'fats'                  => 'required|numeric',
        'protein'               => 'required|numeric',
        'status'                => 'required|integer',
        'created_at'            => 'nullable',
        'updated_at'            => 'nullable',
        'deleted_at'            => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function mealType()
    {
        return $this->belongsTo(\App\Models\MealType::class, 'meal_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function meal()
    {
        return $this->belongsTo(\App\Models\Meal::class, 'meal_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function nutritionPlanDay()
    {
        return $this->belongsTo(\App\Models\NutritionPlanDay::class, 'nutrition_plan_day_id');
    }
}
