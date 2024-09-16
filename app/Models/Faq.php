<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Faq
 * @package App\Models
 * @version January 30, 2024, 11:33 am UTC
 *
 * @property string $question
 * @property string $answer
 * @property integer $status
 */
class Faq extends Model
{
    use SoftDeletes;

    use HasTranslations;

    use HasFactory;

    public $table = 'faqs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    public $translatable = ['question', 'answer'];
    public $appends = ['status_text'];


    public $fillable = [
        'question',
        'answer',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question' => 'string',
        'answer' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question' => 'required|array',
        'question.en' => 'required|string',
        'question.ar' => 'required|string',

        'answer' => 'required|array',
        'answer.en' => 'required|string',
        'answer.ar' => 'required|string',

        'status' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


    public function getStatusTextAttribute()
    {
        return $this->status ? 'Active' : 'In Active';
    }
}
