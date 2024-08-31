<?php

namespace App\Models;

use Eloquent as Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission
 * @package App\Models
 * @version January 10, 2023, 9:09 am UTC
 *
 * @property \App\Models\ModelHasPermission $modelHasPermission
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property string $name
 * @property string $guard_name
 */
class Permission extends SpatiePermission
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'permissions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    const ROUTES = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'];

    const MODULES = ['users', 'meals', 'recipes', 'exercises', 'exercise_equipments', 'appointments'];
    // users,transactions,settings,questions,pages,packages,options,meals,meal_types,meal_categories,exercises,exercise_equipments,body_parts

    public $fillable = [
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
            'name' => 'required|string|max:'.config('constants.validation.permissions.name.size_max'),
            'permissions' => 'required|array',
            'permissions.*.*' => 'required|string|max:'.config('constants.validation.permissions.name.size_max'),
            // 'guard_name' => 'required|string|max:255',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }
    public static function update_rules()
    {
        return [
            'name' => 'required|string|max:'.config('constants.validation.permissions.name.size_max'),
            'permissions' => 'required|array',
            'permissions.*.*' => 'required|string|max:'.config('constants.validation.permissions.name.size_max'),
            // 'guard_name' => 'required|string|max:255',
            'created_at' => 'nullable',
            'updated_at' => 'nullable'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    // public function modelHasPermission()
    // {
    //     return $this->hasOne(\App\Models\ModelHasPermission::class);
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_has_permissions');
    }

    /**
     * Generate Route Permission Lists
     *
     * @param  mixed $table_name
     * @return void
     */
    public function generatePermissions($table_name)
    {
        $routes = array();
        foreach (self::ROUTES as $key => $route) {
            $routes[]['name'] = $table_name . "." . $route;
        }
        return $routes;
    }
}
