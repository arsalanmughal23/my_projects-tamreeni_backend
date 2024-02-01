<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserDetail
 * @package App\Models
 * @version January 30, 2024, 1:30 pm UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $phone_number
 * @property string $dob
 * @property string $image
 * @property boolean $is_social_login
 * @property string $gender
 * @property string $language
 * @property number $height_in_m
 * @property number $current_weight_in_kg
 * @property number $target_weight_in_kg
 * @property string $goal
 * @property string $height_unit
 * @property string $current_weight_unit
 * @property string $target_weight_unit
 * @property string $diet_type
 */
class UserDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_details';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'dob',
        'image',
        'is_social_login',
        'gender',

        'language',
        'height_in_m',
        'current_weight_in_kg',
        'target_weight_in_kg',

        'goal_id',
        'height_unit_id',
        'current_weight_unit_id',
        'target_weight_unit_id',
        'diet_type_id',

        'delete_account_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'address' => 'string',
        'phone_number' => 'string',
        'dob' => 'date',
        'image' => 'string',
        'is_social_login' => 'boolean',
        'gender' => 'string',
        
        'height_in_m' => 'float',
        'current_weight_in_kg' => 'float',
        'target_weight_in_kg' => 'float',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:255',
        'dob' => 'nullable',
        'image' => 'nullable|string|max:255',
        'is_social_login' => 'required|boolean',
        'gender' => 'nullable|string',
        'language' => 'nullable|string',
        'current_weight_in_kg' => 'nullable|numeric',
        'target_weight_in_kg' => 'nullable|numeric',
        'height_in_m' => 'nullable|numeric',
        'goal' => 'nullable|string|max:255',
        'diet_type' => 'nullable|string|max:255',
        'current_weight_unit' => 'nullable|string|max:255',
        'target_weight_unit' => 'nullable|string|max:255',
        'height_unit' => 'nullable|string|max:255',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function deleteAccountType()
    {
        return $this->hasOne(Constant::class, 'id', 'delete_account_type_id');
    }

    public function toArray()
    {
        $variables = $this->only('goal_id', 'diet_type_id', 'current_weight_unit_id', 'target_weight_unit_id', 'height_unit_id');

        // remove null values
        $variables = array_values(array_diff(array_values($variables), [null]));

        $array = parent::toArray();
        $array['variables'] = Constant::whereIn('id', array_values($variables))->pluck('name', 'group');

        return $array;
    }
}
