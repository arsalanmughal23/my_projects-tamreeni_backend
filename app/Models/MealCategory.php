<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MealCategory
 * @package App\Models
 * @version January 30, 2024, 3:04 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $meals
 * @property string $slug
 * @property string $title
 */
class MealCategory extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'meal_categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'slug',
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'slug' => 'string',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'slug' => 'required|string|max:255',
        'title' => 'nullable|string',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function meals()
    {
        return $this->hasMany(\App\Models\Meal::class, 'meal_category_id');
    }
}
