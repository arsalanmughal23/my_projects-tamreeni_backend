<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RecipeIngredient
 * @package App\Models
 * @version July 17, 2024, 12:44 pm UTC
 *
 * @property \App\Models\Recipe $recipe
 * @property integer $recipe_id
 * @property string $type
 * @property string $name
 * @property integer $quantity
 * @property string $unit
 */
class RecipeIngredient extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'recipe_ingredients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CONST_UNITS = ['tsp', 'tbsp', 'fl oz', 'cup', 'pt', 'qt', 'gal', 'ml', 'l', 'oz', 'lb', 'g', 'kg'];
    const CONST_TYPES = ['main', 'sub'];


    protected $dates = ['deleted_at'];



    public $fillable = [
        'recipe_id',
        'type',
        'name',
        'quantity',
        'unit'
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
        'name' => 'json',
        'quantity' => 'integer',
        'unit' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'recipe_id' => 'required|exists:recipes,id',
        'type' => 'required|string',

        'name'     => 'required|array',
        'name.en'  => 'required|string|max:120',
        'name.ar'  => 'required|string|max:120',

        'quantity' => 'required|numeric',
        'unit' => 'required|string',
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
