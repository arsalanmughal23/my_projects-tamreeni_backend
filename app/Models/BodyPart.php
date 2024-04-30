<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class BodyPart
 * @package App\Models
 * @version February 5, 2024, 12:05 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $events
 * @property string $name
 * @property string $image
 */
class BodyPart extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'body_parts';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $translatable = ['name'];

    public $fillable = [
        'name',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'name'  => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'    => 'required|array',
        'name.en' => 'required|string|max:100',
        'name.ar' => 'required|string|max:100',
        'image'   => 'nullable|file',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function events()
    {
        return $this->hasMany(Event::class, 'body_part_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'body_part_id');
    }
}
