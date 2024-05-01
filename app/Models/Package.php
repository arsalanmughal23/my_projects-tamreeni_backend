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

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 2;


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
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
        'currency'    => 'string',
        'amount'      => 'float',
        'sessions'    => 'integer',
        'status'      => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required|string|max:20',
        'description' => 'required|string',
        'currency'    => 'required',
        'amount'      => 'required|numeric',
        'sessions'    => 'required|numeric',
        'status'      => 'nullable|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
