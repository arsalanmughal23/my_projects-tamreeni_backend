<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PromoCode
 * @package App\Models
 * @version July 24, 2024, 5:01 pm UTC
 *
 * @property string $code
 * @property number $value
 * @property string $type
 * @property string $status
 */
class PromoCode extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'promo_codes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    
    const DISCOUNT_FLAT = 'flat';
    const DISCOUNT_PERCENT = 'percent';
    const CONST_TYPE = [self::DISCOUNT_FLAT, self::DISCOUNT_PERCENT];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const CONST_STATUS = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    public $fillable = [
        'code',
        'value',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'value' => 'decimal:2',
        'type' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required|string|max:191|unique:promo_codes,code,{id},id,deleted_at,NULL',
        'value' => 'required|numeric',
        'type' => 'required|string',
        'status' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
