<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Appointment
 * @package App\Models
 * @version April 23, 2024, 10:36 am UTC
 *
 * @property \App\Models\User $customer
 * @property \App\Models\Transaction $transaction
 * @property \App\Models\Slot $slot
 * @property \App\Models\User $user
 * @property integer $customer_id
 * @property integer $user_id
 * @property integer $slot_id
 * @property integer $package_id
 * @property integer $transaction_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property integer $type
 * @property integer $profession_type
 * @property integer $status
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
        'transaction_id',
        'date',
        'start_time',
        'end_time',
        'type',
        'profession_type',
        'status'
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
        'transaction_id'  => 'integer',
        'date'            => 'string',
        'start_time'      => 'string',
        'end_time'        => 'string',
        'type'            => 'integer',
        'profession_type' => 'integer',
        'status'          => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'payment_intent_required'   => 'boolean',
        'user_id'                   => 'required',
        'card_id'                   => 'required',
        'slot_id'                   => 'required_if:type,10',
        'package_id'                => 'required_if:type,20|exists:packages,id',
        'date'                      => 'string|required_if:type,10',
        'start_time'                => 'string|required_if:type,10',
        'end_time'                  => 'string|required_if:type,10',
        'type'                      => 'required|integer|in:10,20',
        'profession_type'           => 'required|integer|in:10,20,30',
        'appointments'              => 'required_if:type,20|array', // appointments array required when type is 20
        'appointments.*.slot_id'    => 'required|required_if:appointments.*.type,20',
        'appointments.*.date'       => 'required|string|max:191|required_if:appointments.*.type,20',
        'appointments.*.start_time' => 'required|string|required_if:appointments.*.type,20',
        'appointments.*.end_time'   => 'required|string|required_if:appointments.*.type,20',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
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
    public function slot()
    {
        return $this->belongsTo(\App\Models\Slot::class, 'slot_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
