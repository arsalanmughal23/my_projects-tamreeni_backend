<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserMembership
 * @package App\Models
 * @version July 29, 2024, 1:26 pm UTC
 *
 * @property \App\Models\MembershipDuration $membershipDuration
 * @property \App\Models\Membership $membership
 * @property \App\Models\User $user
 * @property string $title
 * @property integer $user_id
 * @property integer $membership_id
 * @property integer $membership_duration_id
 * @property integer $duration_in_month
 * @property string|\Carbon\Carbon $expire_at
 * @property string $status
 */
class UserMembership extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_memberships';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'user_id',
        'membership_id',
        'membership_duration_id',
        'duration_in_month',
        'expire_at',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'user_id' => 'integer',
        'membership_id' => 'integer',
        'membership_duration_id' => 'integer',
        'duration_in_month' => 'integer',
        'expire_at' => 'datetime',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string',
        'user_id' => 'required',
        'membership_id' => 'required',
        'membership_duration_id' => 'required',
        'duration_in_month' => 'required',
        'expire_at' => 'nullable',
        'status' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function membershipDuration()
    {
        return $this->belongsTo(\App\Models\MembershipDuration::class, 'membership_duration_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function membership()
    {
        return $this->belongsTo(\App\Models\Membership::class, 'membership_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
