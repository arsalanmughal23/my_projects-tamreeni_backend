<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Translatable\HasTranslations;

/**
 * Class UserMembership
 * @package App\Models
 * @version July 29, 2024, 1:26 pm UTC
 *
 * @property \App\Models\MembershipDuration $membershipDuration
 * @property \App\Models\Membership $membership
 * @property \App\Models\User $user
 * @property json $title
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
    use HasTranslations;

    public $table = 'user_memberships';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];
    public $translatable = ['title'];


    const STATUS_HOLD = 'hold';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_REJECT = 'reject';
    const STATUS_EXPIRE = 'expire';
    const CONST_STATUSES = [self::STATUS_HOLD, self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_REJECT, self::STATUS_EXPIRE];

    public $fillable = [
        'title',
        'user_id',
        'membership_id',
        'membership_duration_id',
        'duration_in_month',
        'expire_at',
        'status',

        'promo_code_id',
        'promo_code',
        'original_price',
        'discount',
        'charge_amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'json',
        'user_id' => 'integer',
        'membership_id' => 'integer',
        'membership_duration_id' => 'integer',
        'duration_in_month' => 'integer',
        'expire_at' => 'datetime',
        'status' => 'string',

        'promo_code_id' => 'integer',
        'promo_code' => 'string',
        'original_price' => 'float',
        'discount' => 'float',
        'charge_amount' => 'float',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|array',
        'title.*' => 'required|string',
        'user_id' => 'required',
        'membership_id' => 'required',
        'membership_duration_id' => 'required',
        'duration_in_month' => 'required',
        'expire_at' => 'nullable',
        'status' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',

        'promo_code_id' => 'sometimes|integer',
        'promo_code' => 'sometimes|string',
        'original_price' => 'required|float',
        'discount' => 'sometimes|float',
        'charge_amount' => 'required|float',
    ];


    /**
     * Get all of the user's usedPromoCodes.
     */
    public function usedPromoCodes(): MorphMany
    {
        return $this->morphMany(UsedPromoCode::class, 'morphable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }

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

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function paymentSuccess()
    {
        $this->update(['status' => self::STATUS_ACTIVE]);
        if($this->usedPromoCodes->count())
            $this->usedPromoCodes()->update(['is_used' => 1]);
        return $this;
    }

    public function paymentReject()
    {
        $this->update(['status' => self::STATUS_REJECT]);
        return $this;
    }
}
