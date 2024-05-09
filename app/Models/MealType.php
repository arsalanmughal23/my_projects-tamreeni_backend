<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class MealType
 * @package App\Models
 * @version March 25, 2024, 9:32 am UTC
 *
 * @property string $name
 * @property integer $status
 */
class MealType extends Model
{
    use SoftDeletes;

    use HasTranslations;

    use HasFactory;

    public $translatable = ['name'];

    public $table = 'meal_types';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_ACTIVE_TEXT = 'Active';
    const STATUS_INACTIVE_TEXT = 'inactive';

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const NAME_BREAKFAST   = 'breakfast';
    const NAME_LUNCH       = 'lunch';
    const NAME_DINNER      = 'dinner';
    const NAME_FRUIT       = 'fruit';
    const NAME_SNACK       = 'snack';
    const ALL_NAMES = [ self::NAME_BREAKFAST, self::NAME_LUNCH, self::NAME_DINNER, self::NAME_FRUIT, self::NAME_SNACK ];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'slug',
        'name',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'     => 'integer',
        'name'   => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'             => 'required|array',
        'name.en'          => 'required|string|max:70',
        'name.ar'          => 'required|string|max:70',
//        'status'     => 'required|integer'
    ];


    public function meals()
    {
        return $this->hasMany(Meal::class, 'meal_type_id');
    }
}
