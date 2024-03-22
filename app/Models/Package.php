<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Package
 * @package App\Models
 * @version March 21, 2024, 5:52 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $transactions
 * @property string $name
 * @property string $description
 * @property string $currency
 * @property number $amount
 * @property integer $sessions
 * @property integer $status
 */
class Package extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'packages';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description',
        'currency',
        'amount',
        'sessions',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'currency' => 'string',
        'amount' => 'float',
        'sessions' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'currency' => 'required|string|max:191',
        'amount' => 'required|numeric',
        'sessions' => 'required|integer',
        'status' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'package_id');
    }
}
