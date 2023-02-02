<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Setting
 * @package App\Models
 * @version January 31, 2023, 11:58 am UTC
 *
 * @property string $title
 * @property string $welcome_title
 * @property string $url
 * @property string $logo
 * @property string $email
 * @property string $contact_number
 * @property string $language
 */
class Setting extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'settings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'welcome_title',
        'url',
        'logo',
        'email',
        'contact_number',
        'language'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'welcome_title' => 'string',
        'url' => 'string',
        'logo' => 'string',
        'email' => 'string',
        'contact_number' => 'string',
        'language' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'welcome_title' => 'required|string|max:255',
        'url' => 'required|max:255',
        'logo' => 'required',
        'email' => 'required|string|max:255',
        'contact_number' => 'required',
        'language' => 'required|string|max:255',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = storeFile(request(), "logo", "public/setting");
    }


}
