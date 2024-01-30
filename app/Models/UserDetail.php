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
 * @property boolean $email_verified_at
 * @property boolean $is_social_login
 * @property string $gender
 * @property string $language
 * @property number $current_weight_in_kg
 * @property number $target_weight_in_kg
 * @property number $height_in_m
 * @property string $goal
 * @property string $diet_type
 * @property string $current_weight_unit
 * @property string $target_weight_unit
 * @property string $height_unit
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
        'email_verified_at',
        'is_social_login',
        'gender',
        'language',
        'current_weight_in_kg',
        'target_weight_in_kg',
        'height_in_m',
        'goal',
        'diet_type',
        'current_weight_unit',
        'target_weight_unit',
        'height_unit'
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
        'email_verified_at' => 'boolean',
        'is_social_login' => 'boolean',
        'gender' => 'string',
        'language' => 'string',
        'current_weight_in_kg' => 'float',
        'target_weight_in_kg' => 'float',
        'height_in_m' => 'float',
        'goal' => 'string',
        'diet_type' => 'string',
        'current_weight_unit' => 'string',
        'target_weight_unit' => 'string',
        'height_unit' => 'string'
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
        'email_verified_at' => 'nullable|boolean',
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
}
