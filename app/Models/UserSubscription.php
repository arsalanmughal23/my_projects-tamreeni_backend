<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UserSubscription
 * @package App\Models
 * @version March 22, 2024, 4:35 pm UTC
 *
 * @property \App\Models\Package $package
 * @property \App\Models\Transaction $transaction
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property integer $package_id
 * @property integer $transaction_id
 * @property integer $sessions
 * @property integer $remaining_sessions
 * @property integer $status
 */
class UserSubscription extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_subscriptions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const ACTIVE     = 1;
    const INACTIVE   = 0;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'package_id',
        'transaction_id',
        'sessions',
        'complete_sessions',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'user_id'            => 'integer',
        'package_id'         => 'integer',
        'transaction_id'     => 'integer',
        'sessions'           => 'integer',
        'complete_sessions' => 'integer',
        'status'             => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'            => 'required',
        'package_id'         => 'required',
        'transaction_id'     => 'required',
        'sessions'           => 'required|integer',
        'complete_sessions' => 'required|integer',
        'status'             => 'required|integer',
        'created_at'         => 'nullable',
        'updated_at'         => 'nullable',
        'deleted_at'         => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function package()
    {
        return $this->belongsTo(\App\Models\Package::class, 'package_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function transaction()
    {
        return $this->belongsTo(\App\Models\Transaction::class, 'transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
