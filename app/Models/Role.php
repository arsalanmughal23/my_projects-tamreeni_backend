<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role
 * @package App\Models
 * @version January 10, 2023, 8:54 am UTC
 *
 * @property \App\Models\ModelHasRole $modelHasRole
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property string $name
 * @property string $guard_name
 */
class Role extends SpatieRole
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const SUPER_ADMIN = 'Super-Admin';
    const ADMIN = 'Admin';
    const API_USER = 'Api-User';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'slug',
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|max:'.config('constants.validation.role.name.size_max'),
            // 'guard_name' => 'nullable|string|max:255',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    // public function modelHasRole()
    // {
    //     return $this->hasOne(\App\Models\ModelHasRole::class);
    // }

    /**
     * The permissions that belong to the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(config('permission.models.permission'), config('permission.table_names.role_has_permissions'));
    }
}
