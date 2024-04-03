<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class NutritionPlanDay
 * @package App\Models
 * @version April 3, 2024, 9:53 am UTC
 *
 * @property \App\Models\NutritionPlan $nutritionPlan
 * @property \Illuminate\Database\Eloquent\Collection $nutritionPlanDayMeals
 * @property integer $nutrition_plan_id
 * @property string $name
 * @property integer $status
 */
class NutritionPlanDay extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;
    public $table = 'nutrition_plan_days';

    public $translatable = ['name'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 20;
    const STATUS_COMPLETED   = 30;


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nutrition_plan_id',
        'name',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'nutrition_plan_id' => 'integer',
        'name'              => 'string',
        'status'            => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nutrition_plan_id' => 'required',
        'name'              => 'required|string|max:255',
        'status'            => 'required|integer',
        'created_at'        => 'nullable',
        'updated_at'        => 'nullable',
        'deleted_at'        => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function nutritionPlan()
    {
        return $this->belongsTo(\App\Models\NutritionPlan::class, 'nutrition_plan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function nutritionPlanDayMeals()
    {
        return $this->hasMany(\App\Models\NutritionPlanDayMeal::class, 'nutrition_plan_day_id');
    }
}
