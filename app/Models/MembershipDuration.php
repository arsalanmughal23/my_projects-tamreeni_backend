<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MembershipDuration
 * @package App\Models
 * @version July 26, 2024, 10:45 am UTC
 *
 * @property \App\Models\Membership $membership
 * @property integer $membership_id
 * @property json $title
 * @property integer $duration_in_month
 * @property number $price
 */
class MembershipDuration extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'membership_durations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'membership_id',
        'title',
        'duration_in_month',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'membership_id' => 'integer',
        'title' => 'json',
        'duration_in_month' => 'integer',
        'price' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'membership_id' => 'required|exists:memberships,id',
        'title' => 'required|array',
        'title.*' => 'required|string',
        'duration_in_month' => 'required|numeric|min:1',
        'price' => 'required|numeric|min:0',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function membership()
    {
        return $this->belongsTo(\App\Models\Membership::class, 'membership_id');
    }
}
