<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Repositories\UsersRepository;
use Flash;
use App\Repositories\RolesRepository;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Role as Role;
use App\Models\User as User;
use App\Repositories\UserDetailRepository;
use Response;

class UsersController extends AppBaseController
{
    /** @var UsersRepository $userRepository */
    private $userRepository;
    private $userDetailRepository;
    private $rolesRepository;

    public function __construct(UsersRepository $userRepo, UserDetailRepository $userDetailRepo, RolesRepository $rolesRepo)
    {
        $this->userRepository       = $userRepo;
        $this->userDetailRepository = $userDetailRepo;
        $this->rolesRepository      = $rolesRepo;

    }

    /**
     * Display a listing of the User.
     *
     * @param UsersDataTable $userDataTable
     *
     * @return Response
     */
    public function index(UsersDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->rolesRepository->all();
        return view('users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateUsersRequest $request)
    {
        $input = $request->all();

        $user       = $this->userRepository->create($input);
        $userDetail = ['user_id' => $user->id];
        $this->userDetailRepository->create($userDetail);

        $roleIds  = array_keys(request()->role);
        $userRole = Role::whereIn('id', $roleIds)->get();

        $user->syncRoles($userRole);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('users', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user  = $this->userRepository->find($id);
        $roles = $this->rolesRepository->all();

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('users.edit')->with(['users' => $user, 'roles' => $roles,]);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsersRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        $roleIds = array_keys(request()->role);
        $user->syncRoles($roleIds);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function assignRoles($id)
    {
        $user  = User::findOrFail($id);
        $roles = Role::all();
        return view('users.assignroles')
            ->with('user', $user)->with('roles', $roles);
    }

    public function updateRoles($id)
    {
        $user = User::findOrFail($id);

        $roleIds = array_keys(request()->role);
        $user->syncRoles($roleIds);

        Flash::success('Roles updated successfully.');
        return redirect(route('users.index'));
    }
}
