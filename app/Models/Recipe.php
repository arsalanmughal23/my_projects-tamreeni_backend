<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * Class Recipe
 * @package App\Models
 * @version July 17, 2024, 4:13 am UTC
 *
 * @property integer $id
 * @property string $diet_type
 * @property json $title
 * @property json $description
 * @property json $instruction
 * @property json $meal_category_ids
 * @property string $image
 * @property integer $units_in_recipe
 * @property integer $divide_recipe_by
 * @property integer $number_of_units
 * @property integer $calories
 * @property number $carbs
 * @property number $fats
 * @property number $protein
 */
class Recipe extends Model
{
    use SoftDeletes;

    use HasTranslations;

    use HasFactory;

    public $table = 'recipes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $appends = ['meal_type_name', 'meal_category_names'];
    public $translatable = ['title', 'description', 'instruction'];


    public $fillable = [
        'diet_type',
        'meal_category_ids',
        'meal_type_id',
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
        'meal_type_id' => 'integer',
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
        'diet_type' => 'required|string|in:traditional,keto',

        'meal_category_ids' => 'required|array|min:1',
        'meal_category_ids.*' => 'required|integer|exists:meal_categories,id',
        'meal_type_id' => 'required|integer|exists:meal_types,id',

        'title'     => 'required|array',
        'title.en'  => 'required|string|max:120',
        'title.ar'  => 'required|string|max:120',

        'description'     => 'required|array',
        'description.en'  => 'required|string|max:500',
        'description.ar'  => 'required|string|max:500',

        'instruction'     => 'required|array',
        'instruction.en'  => 'required|string|max:500',
        'instruction.ar'  => 'required|string|max:500',

        'image'   => 'nullable|file|mimes:jpeg,png|max:5000',

        'units_in_recipe' => 'required|numeric',
        'divide_recipe_by' => 'required|numeric',
        'number_of_units' => 'sometimes|numeric',

        'calories' => ['required', 'numeric'],
        'carbs' => 'required|numeric',
        'fats' => 'required|numeric',
        'protein' => 'required|numeric',

        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function mealCategories():BelongsToMany
    {
        return $this->belongsToMany(MealCategory::class, 'recipe_meal_category_pivots');
    }

    public function mealType():BelongsTo
    {
        return $this->belongsTo(MealType::class);
    }

    public function recipeIngredients():HasMany
    {
        return $this->hasMany(RecipeIngredient::class, 'recipe_id');
    }

    public function getMealCategoryNamesAttribute()
    {
        return $this->mealCategories()->pluck('name');
    }
    public function getMealTypeNameAttribute()
    {
        return $this->mealType->name;
    }
}
