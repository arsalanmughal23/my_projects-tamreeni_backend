<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Membership
 * @package App\Models
 * @version July 26, 2024, 8:24 am UTC
 *
 * @property json $title
 * @property json $feature_list
 * @property string $status
 */
class Membership extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'memberships';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const CONST_STATUSES = ['active', 'inactive'];


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'feature_list',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'json',
        'feature_list' => 'json',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|array',
        'title.*' => 'required|string|max:70',
        'feature_list' => 'required|array',
        'feature_list.*' => 'required|array',
        'feature_list.*.en' => 'required|string|max:70',
        'status' => 'required|string|in:active,inactive',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
