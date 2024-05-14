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

    const EQUIPMENT_TYPE_MACHINE = 'machines';
    const EQUIPMENT_TYPE_FREE_WEIGHT = 'free_weight';
    const EQUIPMENT_TYPE_ALL_EQUIPMENTS = 'all_equipments';
    const EQUIPMENT_TYPE_NO_EQUIPMENT_AT_ALL = 'no_equipment_at_all';
    const EXERCISE_EQUIPMENT_TYPES = [self::EQUIPMENT_TYPE_MACHINE, self::EQUIPMENT_TYPE_FREE_WEIGHT];

    public $fillable = [
        'name',
        'icon',
        'type_slug'
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
        'type_slug' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'    => 'required|array',
        'name.en' => 'required|string|max:70',
        'name.ar' => 'required|string|max:70',
        'icon'    => 'nullable|file|mimes:jpeg,png|max:5000',
        'type_slug' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function events()
    {
        return $this->hasMany(Event::class, 'equipment_id');
    }
}
