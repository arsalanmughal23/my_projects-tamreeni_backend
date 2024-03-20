<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Favourite
 * @package App\Models
 * @version January 30, 2024, 2:44 pm UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property integer $favouritable_id
 * @property string $favouritable_type
 */
class Favourite extends Model
{
    use HasFactory;

    public $table = 'favourites';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const MORPH_TYPE_MEAL = 'meal';
    const MORPH_TYPE_EXERCISE = 'exercise';
    const MORPH_TYPE_EVENT = 'event';
    const MORPH_TYPES = self::MORPH_TYPE_MEAL.','.self::MORPH_TYPE_EXERCISE.','.self::MORPH_TYPE_EVENT;


    public $fillable = [
        'user_id',
        'favouritable_id',
        'favouritable_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'favouritable_id' => 'integer',
        'favouritable_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'user_id' => 'required',
        'favouritable_id' => 'required|integer',
        'favouritable_type' => 'required|string|in:'.self::MORPH_TYPES,
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

    public function favouritable()
    {
        return $this->morphTo();
    }
}
