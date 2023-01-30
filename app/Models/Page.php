<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

/**
 * Class Page
 * @package App\Models
 * @version January 30, 2023, 1:21 pm UTC
 *
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property boolean $active
 */
class Page extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'pages';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'slug',
        'content',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'content' => 'required|string',
        'active' => 'required|boolean',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function setSlugAttribute()
    {
        $this->attributes['slug'] =  Str::slug($this->attributes['title']);
    }

    // public function getContentAttribute()
    // {
    //     $this->attributes['slug'] =  Str::slug($this->attributes['title']);
    // }
}
