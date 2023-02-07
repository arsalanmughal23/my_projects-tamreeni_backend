<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * Class Project
 * @package App\Models
 * @version February 7, 2023, 1:35 pm UTC
 *
 * @property \App\Models\Employee $businessAnalyst
 * @property \App\Models\Employee $projectManager
 * @property \Illuminate\Database\Eloquent\Collection $employee2s
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property integer $project_manager_id
 * @property integer $business_analyst_id
 * @property boolean $active
 */
class Project extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'projects';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'start_date',
        'end_date',
        'project_manager_id',
        'business_analyst_id',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'project_manager_id' => 'integer',
        'business_analyst_id' => 'integer',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'start_date' => 'required',
        'end_date' => 'required',
        'project_manager_id' => 'required',
        'business_analyst_id' => 'required',
        'active' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function businessAnalyst()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'business_analyst_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function projectManager()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'project_manager_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function employee2s()
    {
        return $this->belongsToMany(\App\Models\Employee::class, 'project_resources');
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
