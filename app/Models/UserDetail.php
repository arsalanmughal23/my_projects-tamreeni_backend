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
 * @property boolean $push_notification
 * @property string $gender
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
        'phone_number_country_code',
        'image',
        'is_social_login',
        'push_notification',
        
        'language',
        
        'goal',
        'gender',
        'dob',

        'height_in_m',
        'height_unit',
        'current_weight_in_kg',
        'current_weight_unit',
        'target_weight_in_kg',
        'target_weight_unit',

        'workout_days_in_a_week',
        'workout_duration_per_day',
        'equipment_type',
        'reach_goal_target_date',

        'body_parts',
        'diet_type',
        'food_preferences',

        'level',

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
        'phone_number_country_code' => 'string',
        'dob' => 'date',
        'reach_goal_target_date' => 'date',
        'image' => 'string',
        'is_social_login' => 'boolean',
        'gender' => 'string',
        'push_notification' => 'boolean',
        'body_parts' => 'json',
        'food_preferences' => 'json'
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
}
