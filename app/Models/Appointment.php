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


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'                   => 'required',
        'payment_method_id'         => 'required',
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
        'transaction_id'  => 'integer',
        'date'            => 'string',
        'start_time'      => 'string',
        'end_time'        => 'string',
        'type'            => 'integer',
        'status'          => 'integer',
        'profession_type' => 'integer'
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

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
