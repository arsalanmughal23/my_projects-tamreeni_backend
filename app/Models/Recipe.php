<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Recipe
 * @package App\Models
 * @version July 17, 2024, 4:13 am UTC
 *
 * @property string $diet_type
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
class Recipe extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'recipes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'diet_type',
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
        'title' => 'string',
        'description' => 'string',
        'image' => 'string',
        'instruction' => 'string',
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
        'title' => 'required|string|max:191',
        'description' => 'required|string',
        'image' => 'required|string',
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

    
}
