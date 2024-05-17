<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Exercise
 * @package App\Models
 * @version February 6, 2024, 9:30 am UTC
 *
 * @property \App\Models\BodyPart $bodyPart
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $exerciseEquipmentPivots
 * @property integer $user_id
 * @property integer $body_part_id
 * @property string $name
 * @property number $duration_in_m
 * @property integer $sets
 * @property integer $reps
 * @property number $burn_calories
 * @property string $image
 * @property string $video
 * @property string $description
 */
class Exercise extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'exercises';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $translatable = ['name', 'description'];

    const CATEGORY_MAJOR_LIFT           = 'major_lift';
    const CATEGORY_ACCESSORY_MOVEMENT   = 'accessory_movement';
    const CATEGORY_SINGLE_JOINT         = 'multi_joint';
    const CATEGORY_MULTI_JOINT          = 'single_joint';
    const CATEGORY_CARDIO               = 'cardio';
    const EXERCISE_CATEGORIES = [self::CATEGORY_MAJOR_LIFT, self::CATEGORY_ACCESSORY_MOVEMENT, self::CATEGORY_SINGLE_JOINT, self::CATEGORY_MULTI_JOINT, self::CATEGORY_CARDIO];

    const TYPE_SQUAT    = 'squat';
    const TYPE_DEADLIFT = 'deadlift';
    const TYPE_BENCH    = 'bench';
    const TYPE_OVERHEAD = 'overhead';
    const EXERCISE_TYPES = [self::TYPE_SQUAT, self::TYPE_DEADLIFT, self::TYPE_BENCH, self::TYPE_OVERHEAD];

    const LOW_INTENSITY = 'low';
    const MODERATE_INTENSITY = 'moderate';
    const HIGH_INTENSITY = 'high';
    const VERY_HIGH_INTENSITY = 'very_high';
    const EXERCISE_INTENSITY_LEVELS = [self::LOW_INTENSITY, self::MODERATE_INTENSITY, self::HIGH_INTENSITY, self::VERY_HIGH_INTENSITY];

    const EXERCISE_FACTORS = [
        self::LOW_INTENSITY         => ['sets' => 3, 'reps' => 12, 'percentage' => 60],
        self::MODERATE_INTENSITY    => ['sets' => 4, 'reps' => 8, 'percentage' => 70],
        self::HIGH_INTENSITY        => ['sets' => 5, 'reps' => 5, 'percentage' => 80],
        self::VERY_HIGH_INTENSITY   => ['sets' => 3, 'reps' => 3, 'percentage' => 90],
    ];


    public $fillable = [
        'user_id',
        'body_part_id',
        'name',
        'duration_in_m',
        'sets',
        'reps',
        'burn_calories',
        'image',
        'video',
        'description',
        'exercise_category_name',
        'exercise_type_name'
    ];

    public $appends = ['category_name', 'type_name', 'is_favourite'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'body_part_id'  => 'integer',
        'name'          => 'string',
        'duration_in_m' => 'float',
        'sets'          => 'integer',
        'reps'          => 'integer',
        'burn_calories' => 'float',
        'image'         => 'string',
        'video'         => 'string',
        'description'   => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'        => 'nullable',
        'body_part_id'   => 'required|integer',
        'name'           => 'required|array',
        'name.en'        => 'required|string|max:70',
        'name.ar'        => 'required|string|max:70',
        'description'    => 'required|array',
        'description.en' => 'required|string|max:100',
        'description.ar' => 'required|string|max:100',
        'duration_in_m'  => 'nullable|numeric',
        'sets'           => 'nullable|integer',
        'reps'           => 'nullable|integer',
        'burn_calories'  => 'nullable|numeric',
        'image'          => 'nullable|file|mimes:jpeg,png|max:5000',
        'video'          => 'nullable|file|mimes:mp4|max:20000',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
//    public function exerciseEquipmentPivots()
//    {
//        return $this->hasMany(ExerciseEquipmentPivot::class, 'exercise_id');
//    }

    public function equipment()
    {
        return $this->belongsToMany(ExerciseEquipment::class, 'exercise_equipment_pivots', 'exercise_id', 'exercise_equipment_id');
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    /**
     * @return string
     */
    public function getEquipmentCsvAttribute()
    {
        return implode(",", $this->equipment->pluck('name')->all());
    }

    public function getIsFavouriteAttribute()
    {
        $userId      = auth()->user()->id ?? null;
        $isFavourite = false;

        if ($userId) {
            $isFavourite = $this->favourites()->where('user_id', $userId)->exists();
        }
        return $isFavourite;
    }

    public function getCategoryNameAttribute()
    {
        return $this->exercise_category_name ? __('general.'.$this->exercise_category_name) : null;
    }
    public function getTypeNameAttribute()
    {
        return $this->exercise_type_name ? __('general.'.$this->exercise_type_name) : null;
    }
}
