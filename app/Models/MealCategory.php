<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class MealCategory
 * @package App\Models
 * @version January 30, 2024, 3:04 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $meals
 * @property string $diet_type
 * @property string $name
 */
class MealCategory extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;
    public $table = 'meal_categories';

    public $translatable = ['name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'diet_type',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'diet_type' => 'string',
        'name'      => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'      => 'required|array',
        'name.en'   => 'required|string|max:50',
        'name.ar'   => 'required|string|max:50',
        'diet_type' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function meals()
    {
        return $this->hasMany(Meal::class, 'meal_category_id');
    }
}
