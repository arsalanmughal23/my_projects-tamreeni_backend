<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public $table = 'exercises';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



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
        'description'
    ];

    public $appends = ['is_favourite'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'body_part_id' => 'integer',
        'name' => 'string',
        'duration_in_m' => 'float',
        'sets' => 'integer',
        'reps' => 'integer',
        'burn_calories' => 'float',
        'image' => 'string',
        'video' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable',
        'body_part_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'duration_in_m' => 'nullable|numeric',
        'sets' => 'nullable|integer',
        'reps' => 'nullable|integer',
        'burn_calories' => 'nullable|numeric',
        'image' => 'nullable|string',
        'video' => 'nullable|string',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bodyPart()
    {
        return $this->belongsTo(\App\Models\BodyPart::class, 'body_part_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function exerciseEquipmentPivots()
    {
        return $this->hasMany(\App\Models\ExerciseEquipmentPivot::class, 'exercise_id');
    }

    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function getIsFavouriteAttribute()
    {
        $userId = auth()->user()->id ?? null;
        $isFavourite = false;

        if ($userId) {
            $isFavourite = $this->favourites()->where('user_id', $userId)->exists();
        }
        return $isFavourite;
    }
}
