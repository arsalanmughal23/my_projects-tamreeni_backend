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
 * @property integer $id
 * @property string $diet_type
 * @property json $title
 * @property json $description
 * @property json $instruction
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
        'diet_type' => 'required|string',
        
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

    
}
