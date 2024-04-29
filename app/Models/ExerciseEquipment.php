<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class ExerciseEquipment
 * @package App\Models
 * @version February 5, 2024, 12:05 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $events
 * @property string $name
 * @property string $icon
 */
class ExerciseEquipment extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'exercise_equipments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $translatable = ['name'];

    public $fillable = [
        'name',
        'icon',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
        'icon' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'    => 'required|array',
        'name.en' => 'required|string|max:20',
        'name.ar' => 'required|string|max:20',
        'icon'    => 'nullable|file',
        'type'    => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function events()
    {
        return $this->hasMany(\App\Models\Event::class, 'equipment_id');
    }
}
