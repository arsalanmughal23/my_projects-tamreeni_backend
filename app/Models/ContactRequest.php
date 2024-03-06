<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ContactRequest
 * @package App\Models
 * @version March 6, 2024, 1:31 pm UTC
 *
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $subject
 * @property string $message
 */
class ContactRequest extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contact_requests';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'subject',
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'subject' => 'string',
        'message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    
}
