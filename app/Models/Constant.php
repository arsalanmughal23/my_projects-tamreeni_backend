<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Constant
 * @package App\Models
 * @version February 7, 2023, 10:10 am UTC
 *
 * @property integer $instance_type
 * @property string $text
 * @property integer $value
 */
class Constant extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'constants';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'instance_type',
        'text',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'instance_type' => 'integer',
        'text' => 'string',
        'value' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'instance_type' => 'required|integer',
        'text' => 'required|string|max:255',
        'value' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
