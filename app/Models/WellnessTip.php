<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class WellnessTip
 * @package App\Models
 * @version January 30, 2024, 1:30 pm UTC
 *
 * @property string $title
 * @property string $content
 * @property string $cover
 */
class WellnessTip extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;

    public $table = 'wellness_tips';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    public $translatable = ['title', 'content'];


    public $fillable = [
        'title',
        'content',
        'cover'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'cover' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|array',
        'title.en' => 'required|string',
        'title.ar' => 'required|string',

        'content' => 'required|array',
        'content.en' => 'required|string',
        'content.ar' => 'required|string',

        'cover' => 'nullable|file|mimes:jpeg,png|max:5000',

        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
