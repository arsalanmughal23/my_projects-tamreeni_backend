<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePermissionsRequest;
use App\Http\Requests\UpdatePermissionsRequest;
use App\Repositories\PermissionsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Response;

class PermissionsController extends AppBaseController
{
    /** @var PermissionsRepository $permissionsRepository*/
    private $permissionsRepository;

    public function __construct(PermissionsRepository $permissionsRepo)
    {
        $this->permissionsRepository = $permissionsRepo;
    }

    /**
     * Display a listing of the Permissions.
     *
     * @param PermissionsDataTable $permissionsDataTable
     *
     * @return Response
     */
    public function index(PermissionsDataTable $permissionsDataTable)
    {
        return $permissionsDataTable->render('permissions.index');
    }

    /**
     * Show the form for creating a new Permissions.
     *
     * @return Response
     */
    public function create()
    {
        $moduleNamesThatPermissionisExists = $this->getModuleNamesThatPermissionExists();
        $modules = array_diff(Permission::MODULES, $moduleNamesThatPermissionisExists->toArray());
        $moduleName = null;
        $permissions = collect();
        return view('permissions.create', compact('moduleName','modules','permissions'));
    }

    public function getModuleNamesThatPermissionExists()
    {
        // Subquery that selects distinct module names
        $subQuery = DB::table('permissions')
            ->select(DB::raw('DISTINCT SUBSTRING_INDEX(name, ".", 1) as module_name'));

        // Wrapping the subquery and returning pluck values of 'module_name'
        return Permission::query()
            ->from(DB::raw("({$subQuery->toSql()}) as sub"))
            ->mergeBindings($subQuery)
            ->whereIn('module_name', Permission::MODULES)
            ->pluck('module_name');
    }

    /**
     * Store a newly created Permissions in storage.
     *
     * @param CreatePermissionsRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionsRequest $request)
    {
        $input = $request->all();

        $modulePermissions = [];
        foreach($input['permissions'] as $module => $permissions) {
            foreach($permissions as $action => $permission) {
                $modulePermissions[] = $this->permissionsRepository->updateOrCreate(['name' => $permission], ['name' => $permission]);
            }
        }

        $this->permissionsRepository->where('name', 'like', $input['name'].'%')
            ->whereNotIn('name', collect($modulePermissions)->pluck('name'))
            ->delete();

        Flash::success('Permissions saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permissions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permissions = $this->permissionsRepository->find($id);

        if (empty($permissions)) {
            Flash::error('Permissions not found');

            return redirect(route('permissions.index'));
        }

        return view('permissions.show')->with('permissions', $permissions);
    }

    /**
     * Show the form for editing the specified Permissions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($moduleName)
    {
        $permissions = $this->permissionsRepository->where('name', 'like', "$moduleName.%")->pluck('name');

        if (!$permissions->count()) {
            Flash::error('Module not found');
            return redirect(route('permissions.index'));
        }

        $moduleNamesThatPermissionisExists = $this->getModuleNamesThatPermissionExists();
        $modules = array_intersect(Permission::MODULES, $moduleNamesThatPermissionisExists->toArray());
        return view('permissions.edit', compact('permissions', 'modules', 'moduleName'));
    }

    /**
     * Update the specified Permissions in storage.
     *
     * @param int $id
     * @param UpdatePermissionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionsRequest $request)
    {
        $input = $request->all();

        $modulePermissions = [];
        foreach($input['permissions'] as $module => $permissions) {
            foreach($permissions as $action => $permission) {
                $modulePermissions[] = $this->permissionsRepository->updateOrCreate(['name' => $permission], ['name' => $permission]);
            }
        }

        $this->permissionsRepository->where('name', 'like', $input['name'].'%')
            ->whereNotIn('name', collect($modulePermissions)->pluck('name'))
            ->delete();

        Flash::success('Permissions saved successfully.');

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permissions from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($moduleName)
    {
        $modulePermissions = $this->permissionsRepository->where('name', 'like', "$moduleName.%")->get();

        $roles = Role::all();
        foreach ($roles as $role) {
            $role->revokePermissionTo($modulePermissions);
        }

        $this->permissionsRepository->where('name', 'like', "$moduleName.%")->delete();

        Flash::success('Permissions deleted successfully.');

        return redirect(route('permissions.index'));
    }
}
