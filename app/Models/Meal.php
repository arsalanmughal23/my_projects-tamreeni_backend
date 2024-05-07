<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Meal
 * @package App\Models
 * @version January 30, 2024, 3:05 pm UTC
 *
 * @property \App\Models\MealCategory $mealCategory
 * @property string $diet_type
 * @property integer $meal_category_id
 * @property string $name
 * @property string $image
 * @property number $calories
 * @property string $description
 */
class Meal extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'meals';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const DIET_TYPE_TRADITION_EN = "traditional";
    const DIET_TYPE_TRADITION_AR = "تقليدي";
    const DIET_TYPE_KETO_EN      = "keto";
    const DIET_TYPE_KETO_AR      = "كيتو";

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $translatable = ['name', 'description', 'diet_type'];

    public $fillable = [
        'diet_type',
        'meal_category_id',
        'meal_type_id',
        'name',
        'image',
        'calories',
        'protein',
        'fats',
        'carbs',
        'description'
    ];

    public $appends = ['is_favourite'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
//        'id'               => 'integer',
//        'diet_type'        => 'string',
//        'meal_category_id' => 'integer',
//        'meal_type_id'     => 'integer',
//        'name'             => 'string',
//        'image'            => 'string',
//        'calories'         => 'float',
//        'description'      => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diet_type'        => 'nullable|string|in:traditional,keto',
        'meal_category_id' => 'required|integer',
        'meal_type_id'     => 'required|integer',
        'name'             => 'required|array',
        'name.en'          => 'required|string|max:70',
        'name.ar'          => 'required|string|max:70',
        'image'            => 'nullable|file|mimes:jpeg,png|max:5000',
        'calories'         => 'nullable|numeric',
        'description'      => 'nullable|array',
        'description.en'   => 'required|string|max:200',
        'description.ar'   => 'required|string|max:200',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function mealCategory()
    {
        return $this->belongsTo(MealCategory::class, 'meal_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function mealType()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getIsFavouriteAttribute()
    {
        $userId      = auth()->user()->id ?? null;
        $isFavourite = false;

        if ($userId) {
            $isFavourite = $this->favourites()->where('user_id', $userId)->exists();
        }
        return $isFavourite;
    }
}
