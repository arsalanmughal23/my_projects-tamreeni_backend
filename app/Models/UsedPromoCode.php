<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class UsedPromoCode
 * @package App\Models
 * @version July 25, 2024, 9:36 am UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $morphable_type
 * @property integer $morphable_id
 * @property string $code
 * @property number $value
 * @property string $type
 * @property any $morphable
 */
class UsedPromoCode extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'used_promo_codes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    public $appends = ['reference_module_name', 'reference_item_link', 'reference_item_title'];



    public $fillable = [
        'user_id',
        'email',
        'morphable_type',
        'morphable_id',
        'code',
        'value',
        'type',
        'is_used'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'user_id' => 'integer',
        'morphable_type' => 'string',
        'morphable_id' => 'integer',
        'code' => 'string',
        'value' => 'decimal:2',
        'type' => 'string',
        'is_used' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'email' => 'required|string',
        'morphable_type' => 'required|string|max:191',
        'morphable_id' => 'required',
        'code' => 'required|string|max:191',
        'value' => 'required|numeric',
        'type' => 'required|string',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function morphable()
    {
        return $this->morphTo();
    }

    public function getReferenceModuleNameAttribute()
    {
        return basename($this->morphable_type ?? '');
    }
    public function getReferenceItemLinkAttribute()
    {
        return match ($this->morphable_type) {
            User::class => route('users.show', $this->morphable_id),
            default => '#'
        };
    }
    public function getReferenceItemTitleAttribute()
    {
        $title = $this->morphable?->title;
        $identity = '#'.$this->morphable_id . ($title ? ', @'.$title : null);
        return $identity;
    }
}
