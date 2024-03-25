<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Appointment
 * @package App\Models
 * @version March 21, 2024, 5:51 pm UTC
 *
 * @property \App\Models\User $customer
 * @property \App\Models\Slot $slot
 * @property \App\Models\User $user
 * @property integer $customer_id
 * @property integer $user_id
 * @property integer $slot_id
 * @property integer $package_id
 * @property integer $transaction_id
 * @property string $date
 * @property integer $type
 * @property integer $profession_type
 */
class Appointment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'appointments';

    const CREATED_AT                = 'created_at';
    const UPDATED_AT                = 'updated_at';
    const TYPE_SESSION              = 10;
    const TYPE_PACKAGE              = 20;
    const PROFESSION_TYPE_COACH     = 10;
    const PROFESSION_TYPE_DIETITIAN = 20;
    const PROFESSION_TYPE_THERAPIST = 30;

    const STATUS_PENDING = 0;
    const STATUS_START   = 1;
    const STATUS_END     = 2;
    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_id',
        'user_id',
        'slot_id',
        'package_id',
        'date',
        'start_time',
        'end_time',
        'amount',
        'type',
        'status',
        'profession_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'customer_id'     => 'integer',
        'user_id'         => 'integer',
        'slot_id'         => 'integer',
        'package_id'      => 'integer',
        'date'            => 'string',
        'start_time'      => 'string',
        'end_time'        => 'string',
        'currency'        => 'string',
        'amount'          => 'float',
        'type'            => 'integer',
        'status'          => 'integer',
        'profession_type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'           => 'required',
        'payment_method_id' => 'required',
        'slot_id'           => 'nullable',
        'package_id'        => 'nullable',
        'date'              => 'required|string|max:191',
        'start_time'        => 'required|string',
        'end_time'          => 'required|string',
        'type'              => 'required|integer',
        'profession_type'   => 'required|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
