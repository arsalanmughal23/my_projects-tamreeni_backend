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
 * @property integer $instance_id
 * @property string $instance_type
 */
class Favourite extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'favourites';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'instance_id',
        'instance_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'instance_id' => 'integer',
        'instance_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'instance_id' => 'required|integer',
        'instance_type' => 'required|string|max:255',
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
     * @return \Illuminate\Database\Eloquent\Relations\morphTo
     **/
    public function instance()
    {
        return $this->morphTo('instance');
    }
}
