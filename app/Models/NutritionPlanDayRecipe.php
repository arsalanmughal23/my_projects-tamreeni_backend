<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

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
 * @property integer $status
 */
class NutritionPlanDayRecipe extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;

    public $table = 'nutrition_plan_day_recipes';

    public $translatable = ['title', 'description', 'instruction'];
    protected $appends = ['meal_type_name', 'meal_category_names', 'is_favourite'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_TODO        = 10;
    const STATUS_IN_PROGRESS = 20;
    const STATUS_COMPLETED   = 30;

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
        'protein',
        'status'
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
        'protein' => 'float',
        'status' => 'integer'
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

        'title' => 'required|array',
        'title.en' => 'required|string',
        'title.ar' => 'required|string',
        'description' => 'required|array',
        'description.en' => 'required|string',
        'description.ar' => 'required|string',
        'instruction' => 'required|array',
        'instruction.en' => 'required|string',
        'instruction.ar' => 'required|string',

        'image' => 'nullable|string',
        'units_in_recipe' => 'required',
        'divide_recipe_by' => 'required',
        'number_of_units' => 'required',
        'calories' => 'required',
        'carbs' => 'required|numeric',
        'fats' => 'required|numeric',
        'protein' => 'required|numeric',
        'status' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public static $update_rules = [
        'diet_type' => 'sometimes|string',
        'nutrition_plan_day_id' => 'sometimes|integer',
        'meal_type_id' => 'sometimes',
        'recipe_id' => 'sometimes',
        'meal_category_ids' => 'sometimes|string',
        'title' => 'required|array',
        'title.en' => 'required|string',
        'title.ar' => 'required|string',
        'description' => 'required|array',
        'description.en' => 'required|string',
        'description.ar' => 'required|string',
        'instruction' => 'required|array',
        'instruction.en' => 'required|string',
        'instruction.ar' => 'required|string',
        'image' => 'sometimes|string',
        'units_in_recipe' => 'sometimes',
        'divide_recipe_by' => 'sometimes',
        'number_of_units' => 'sometimes',
        'calories' => 'sometimes',
        'carbs' => 'sometimes|numeric',
        'fats' => 'sometimes|numeric',
        'protein' => 'sometimes|numeric',
        'status' => 'sometimes|integer',
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
    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class, 'recipe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function nutritionPlanDay()
    {
        return $this->belongsTo(\App\Models\NutritionPlanDay::class, 'nutrition_plan_day_id');
    }

    public function mealCategories()
    {
        return $this->belongsToMany(MealCategory::class, 'recipe_meal_category_pivots');
    }

    public function nPlanDayRecipeIngredients():HasMany
    {
        return $this->hasMany(NplanDayRecipeIngredient::class, 'nplan_day_recipe_id');
    }

    public function getMealCategoryNamesAttribute()
    {
        return $this->mealCategories()->pluck('name');
    }
    public function getMealTypeNameAttribute()
    {
        return $this->mealType->name;
    }

    public function getIsFavouriteAttribute()
    {
        return $this->recipe?->is_favourite ?? false;
    }
}
