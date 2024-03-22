<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transaction
 * @package App\Models
 * @version March 21, 2024, 5:52 pm UTC
 *
 * @property \App\Models\Package $package
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property integer $package_id
 * @property string $transaction_id
 * @property string $data
 * @property string $currency
 * @property number $amount
 * @property string $status
 */
class Transaction extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'package_id',
        'transaction_id',
        'data',
        'currency',
        'amount',
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
        'package_id' => 'integer',
        'transaction_id' => 'string',
        'data' => 'string',
        'currency' => 'string',
        'amount' => 'float',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'package_id' => 'nullable',
        'transaction_id' => 'required|string|max:255',
        'data' => 'required|string',
        'currency' => 'required|string|max:191',
        'amount' => 'required|numeric',
        'status' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
