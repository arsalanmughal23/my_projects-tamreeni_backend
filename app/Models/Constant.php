<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Constant
 * @package App\Models
 * @version January 29, 2024, 2:22 pm UTC
 *
 * @property string $name
 * @property string $group
 * @property string $key
 * @property string $value
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
        'name',
        'group',
        'key',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'group' => 'string',
        'key' => 'string',
        'value' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'group' => 'required|string|max:255',
        'key' => 'required|string|max:255',
        'value' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * Set the value attribute by concatenating group and key.
     *
     * @param  string  $value
     * @return void
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->attributes['group'] . '__' . $this->attributes['key'];
    }

    
}
