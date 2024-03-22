<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Slot
 * @package App\Models
 * @version March 21, 2024, 12:24 pm UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $slot_time
 * @property integer $type
 */
class Slot extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'slots';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const MORNING   = 10;
    const AFTERNOON = 20;
    const EVENING   = 30;

    public static $typeTexts = [
        self::MORNING   => 'Morning',
        self::AFTERNOON => 'Afternoon',
        self::EVENING   => 'Evening',
    ];

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'day',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id'    => 'integer',
        'start_time' => 'string',
        'end_time'   => 'string',
        'day'        => 'string',
        'type'       => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'    => 'required',
        'start_time' => 'required|string|max:191',
        'end_time'   => 'required|string|max:191',
        'day'        => 'required|string|in:mon,tue,wed,thus,fri,sat,sun',
        'type'       => 'required|integer|in:10,20,30',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
