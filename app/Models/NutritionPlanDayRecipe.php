<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class NutritionPlanDayRecipe
 * @package App\Models
 * @version July 18, 2024, 6:36 pm UTC
 *
 * @property \App\Models\MealType $mealType
 * @property \App\Models\NutritionPlanDay $nutritionPlanDay
 * @property \App\Models\Recipe $recipe
 * @property string $diet_type
 * @property integer $nutrition_plan_day_id
 * @property integer $meal_type_id
 * @property integer $recipe_id
 * @property string $meal_category_ids
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $instruction
 * @property integer $units_in_recipe
 * @property integer $divide_recipe_by
 * @property integer $number_of_units
 * @property integer $calories
 * @property number $carbs
 * @property number $fats
 * @property number $protein
 */
class NutritionPlanDayRecipe extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'nutrition_plan_day_recipes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'diet_type',
        'nutrition_plan_day_id',
        'meal_type_id',
        'recipe_id',
        'meal_category_ids',
        'title',
        'description',
        'image',
        'instruction',
        'units_in_recipe',
        'divide_recipe_by',
        'number_of_units',
        'calories',
        'carbs',
        'fats',
        'protein'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diet_type' => 'string',
        'nutrition_plan_day_id' => 'integer',
        'meal_type_id' => 'integer',
        'recipe_id' => 'integer',
        'meal_category_ids' => 'json',
        'title' => 'json',
        'description' => 'json',
        'instruction' => 'json',
        'image' => 'string',
        'units_in_recipe' => 'integer',
        'divide_recipe_by' => 'integer',
        'number_of_units' => 'integer',
        'calories' => 'integer',
        'carbs' => 'float',
        'fats' => 'float',
        'protein' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diet_type' => 'required|string',
        'nutrition_plan_day_id' => 'required',
        'meal_type_id' => 'required',
        'recipe_id' => 'nullable',
        'meal_category_ids' => 'required|string',
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'nullable|string',
        'instruction' => 'required|string',
        'units_in_recipe' => 'required',
        'divide_recipe_by' => 'required',
        'number_of_units' => 'required',
        'calories' => 'required',
        'carbs' => 'required|numeric',
        'fats' => 'required|numeric',
        'protein' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
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
    public function nutritionPlanDay()
    {
        return $this->belongsTo(\App\Models\NutritionPlanDay::class, 'nutrition_plan_day_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class, 'recipe_id');
    }

    public function mealCategories()
    {
        return $this->belongsToMany(MealCategory::class, 'recipe_meal_category_pivots');
    }
}
