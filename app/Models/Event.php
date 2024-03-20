<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Event
 * @package App\Models
 * @version February 5, 2024, 12:05 pm UTC
 *
 * @property \App\Models\BodyPart $bodyPart
 * @property \App\Models\ExerciseEquipment $equipment
 * @property \App\Models\User $user
 * @property string $title
 * @property string $date
 * @property time $start_time
 * @property time $end_time
 * @property integer $duration
 * @property string $description
 * @property string $image
 * @property integer $user_id
 * @property integer $body_part_id
 * @property integer $equipment_id
 */
class Event extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'events';

    const CREATED_AT     = 'created_at';
    const UPDATED_AT     = 'updated_at';
    const UPCOMING_EVENT = 10;
    const ONGOING_EVENT  = 20;
    const COMPLETE_EVENT = 30;


    protected $dates = ['deleted_at'];

    public $translatable = ['title', 'description'];

    public $fillable = [
        'title',
        'date',
        'start_time',
        'end_time',
        'duration',
        'description',
        'image',
        'user_id',
        'body_part_id',
        'status',
        'equipment_id'
    ];

    protected $appends = ['is_interested'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'title'        => 'string',
        'date'         => 'date',
        'duration'     => 'integer',
        'description'  => 'string',
        'image'        => 'string',
        'user_id'      => 'integer',
        'body_part_id' => 'integer',
        'status'       => 'integer',
        'equipment_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'          => 'required|array',
        'title.en'       => 'required|string',
        'title.ar'       => 'required|string',
        'date'           => 'required|date',
        'start_time'     => 'required',
        'end_time'       => 'required',
        'duration'       => 'nullable|integer',
        'description'    => 'required|array',
        'description.en' => 'required|string',
        'description.ar' => 'required|string',
        'image'          => 'nullable|string',
        'body_part_id'   => 'nullable|integer',
        'equipment_id'   => 'nullable|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bodyPart()
    {
        return $this->belongsTo(BodyPart::class, 'body_part_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function equipment()
    {
        return $this->belongsTo(ExerciseEquipment::class, 'equipment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function user_events()
    {
        return $this->hasMany(UserEvent::class);
    }

    public function interested()
    {
        if (auth()->user()) {
            return $this->hasOne(Favourite::class, 'favouritable_id')->where('favouritable_type', 'event')->where('user_id', auth()->user()->id);
        } else {
            return $this->hasOne(Favourite::class, 'favouritable_id');
        }
    }

    public function getIsInterestedAttribute()
    {
        return !empty($this->interested);
    }
}
