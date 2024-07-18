<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class NplanDayRecipeIngredient
 * @package App\Models
 * @version July 18, 2024, 6:53 pm UTC
 *
 * @property \App\Models\Recipe $recipe
 * @property integer $recipe_id
 * @property string $type
 * @property string $name
 * @property integer $quantity
 * @property string $unit
 * @property integer $scaled_quantity
 * @property string $scaled_unit
 */
class NplanDayRecipeIngredient extends Model
{
    use SoftDeletes;

    use HasFactory;
    use HasTranslations;

    public $table = 'nplan_day_recipe_ingredients';

    public $translatable = ['name'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'recipe_id',
        'type',
        'name',
        'quantity',
        'unit',
        'scaled_quantity',
        'scaled_unit'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'recipe_id' => 'integer',
        'type' => 'string',
        'name' => 'string',
        'quantity' => 'integer',
        'unit' => 'string',
        'scaled_quantity' => 'integer',
        'scaled_unit' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'recipe_id' => 'required',
        'type' => 'required|string',
        'name' => 'required|string',
        'quantity' => 'required',
        'unit' => 'required|string',
        'scaled_quantity' => 'required',
        'scaled_unit' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class, 'recipe_id');
    }
}
