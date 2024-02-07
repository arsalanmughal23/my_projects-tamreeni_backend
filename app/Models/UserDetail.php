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
        'dob',
        'image',
        'is_social_login',
        'push_notification',
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
        'push_notification' => 'boolean',
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
