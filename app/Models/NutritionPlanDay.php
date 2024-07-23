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

    public $appends = ['day_target_calories', 'day_take_in_calories'];

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nutrition_plan_id',
        'name',
        'date',
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


    protected static function booted()
    {
        static::created(function ($nutritionPlanDay) {
            $nutritionPlanDayName = '0' . $nutritionPlanDay->name;
            $nutritionPlanDay->update([
                'name' => [
                    'en' => __('nutrition_plan_day.day_name', ['daynumber' => $nutritionPlanDayName], 'en'),
                    'ar' => __('nutrition_plan_day.day_name', ['daynumber' => $nutritionPlanDayName], 'ar')
                ]
            ]);
        });
    }

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
    public function nutritionPlanDayRecipes()
    {
        return $this->hasMany(\App\Models\NutritionPlanDayRecipe::class, 'nutrition_plan_day_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function nutritionPlanDayMeals()
    {
        return $this->hasMany(\App\Models\NutritionPlanDayMeal::class, 'nutrition_plan_day_id')->with(['mealType', 'meal']);
    }

    public function getDayTargetCaloriesAttribute() 
    {
        return $this->nutritionPlanDayMeals()->sum('calories');
    }
    
    public function getDayTakeInCaloriesAttribute() 
    {
        return $this->nutritionPlanDayMeals()->where('status', NutritionPlanDayMeal::STATUS_COMPLETED)->sum('calories');
    }
}
