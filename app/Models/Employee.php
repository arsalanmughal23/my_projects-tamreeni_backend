<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Employee
 * @package App\Models
 * @version February 7, 2023, 11:52 am UTC
 *
 * @property \App\Models\Stack $stack
 * @property \Illuminate\Database\Eloquent\Collection $projects
 * @property \Illuminate\Database\Eloquent\Collection $project1s
 * @property \Illuminate\Database\Eloquent\Collection $project2s
 * @property \Illuminate\Database\Eloquent\Collection $sprints
 * @property \Illuminate\Database\Eloquent\Collection $sprint3s
 * @property string $name
 * @property string $email
 * @property integer $level
 * @property integer $code
 * @property integer $stack_id
 */
class Employee extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'employees';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'level',
        'code',
        'stack_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'level' => 'integer',
        'code' => 'integer',
        'stack_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'level' => 'required|integer',
        'code' => 'nullable|integer',
        'stack_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function stack()
    {
        return $this->belongsTo(\App\Models\Stack::class, 'stack_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function projects()
    {
        return $this->belongsToMany(\App\Models\Project::class, 'project_resources');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function project1s()
    {
        return $this->hasMany(\App\Models\Project::class, 'business_analyst_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function project2s()
    {
        return $this->hasMany(\App\Models\Project::class, 'project_manager_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sprints()
    {
        return $this->hasMany(\App\Models\Sprint::class, 'business_analyst_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function sprint3s()
    {
        return $this->hasMany(\App\Models\Sprint::class, 'project_manager_id');
    }

    public function getLevelNameAttribute($value)
    {
        return ucfirst(getConstantValue($value));
    }
}
