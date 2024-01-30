<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserSocialAccount
 * @package App\Models
 * @version January 27, 2024, 1:02 am UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $platform
 * @property string $client_id
 * @property string $token
 * @property string|\Carbon\Carbon $expires_at
 * @property boolean $status
 */
class UserSocialAccount extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_social_accounts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'platform',
        'client_id',
        'token',
        'expires_at',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'platform' => 'string',
        'client_id' => 'string',
        'token' => 'string',
        'expires_at' => 'datetime',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'platform' => 'required|string|max:255',
        'client_id' => 'required|string|max:255',
        'token' => 'required|string|max:255',
        'expires_at' => 'nullable',
        'status' => 'required|boolean',
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
