<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Constant
 * @package App\Models
 * @version January 29, 2024, 2:22 pm UTC
 *
 * @property string $name
 * @property string $group
 * @property string $key
 * @property string $unique_key
 */
class Constant extends Model
{
    use HasFactory;

    public $table = 'constants';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const GROUP_DELETE_ACCOUNT_TYPE = 'delete_account_type';
    const GROUP_GOAL = 'goal';
    const GROUP_DIET_TYPE = 'diet_type';
    const GROUP_CURRENT_WEIGHT_UNIT = 'current_weight_unit';
    const GROUP_TARGET_WEIGHT_UNIT = 'target_weight_unit';
    const GROUP_HEIGHT_UNIT = 'height_unit';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'group',
        'key',
        'unique_key'
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
        'unique_key' => 'string'
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
        'unique_key' => 'nullable|string|unique|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * Set the unique_key attribute by concatenating group and key.
     *
     * @param  string  $unique_key
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $key = str_replace(' ', '_', strtolower($name));
        $this->attributes['key'] = $key;
        $this->attributes['unique_key'] = $this->attributes['group'] . '__' . $key;

        return $this->attributes;
    }

    
}
