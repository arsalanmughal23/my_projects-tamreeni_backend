<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserDetail
 * @package App\Models
 * @version January 26, 2024, 8:34 pm UTC
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
        'gender'
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
        'gender' => 'string'
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
