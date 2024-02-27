<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public $table = 'meals';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'diet_type',
        'meal_category_id',
        'name',
        'image',
        'calories',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diet_type' => 'string',
        'meal_category_id' => 'integer',
        'name' => 'string',
        'image' => 'string',
        'calories' => 'float',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diet_type' => 'nullable|string',
        'meal_category_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'image' => 'nullable|string|max:255',
        'calories' => 'nullable|numeric',
        'description' => 'nullable|string',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function mealCategory()
    {
        return $this->belongsTo(\App\Models\MealCategory::class, 'meal_category_id');
    }

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphToMany
     **/
    public function favourites()
    {
        return $this->morphToMany(\App\Models\Favourite::class, 'favouritable', 'instance_type', 'instance_id');
    }

    protected static function booted()
    {
        static::retrieved(function ($exercise) {
            $userId = auth()->user()->id;
            $exercise->append('favourite');
        });
    }
    public function getFavouriteAttribute()
    {
        $userId = auth()->user()->id;
        return \App\Models\Favourite::where('instance_id', $this->id)
            ->where('instance_type', 'meal')
            ->where('user_id', $userId)
            ->exists();
    }
}
