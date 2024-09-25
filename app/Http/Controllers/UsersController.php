<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Helper\FileHelper;
use App\Http\Controllers\API\PaymentController;
use App\Http\Requests;
use App\Http\Requests\CreateUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Repositories\UsersRepository;
use Flash;
use App\Repositories\RolesRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User as User;
use App\Models\Role as UserRole;
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
        $roles = $this->getPossibleRoles(auth()->user());
        return view('users.create')->with('roles', $roles);
    }

    public function getPossibleRoles($user)
    {
        $isSuperAdmin = $user->hasRole(Role::SUPER_ADMIN);

        $roles = Role::MENTOR;
        $isSuperAdmin ? array_push($roles, Role::ADMIN) : null;
        return $this->rolesRepository->whereIn('name', $roles)->get();
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

        if(UserRole::ADMIN_ID != request()->role){
            $paymentController = new PaymentController();
            $emailRequest      = new Request(['email' => $input['email']]);

            $stripe_customer             = $paymentController::post($emailRequest, 'create.customer');
            $input['stripe_customer_id'] = $stripe_customer['data']['id'];
        }

        $user = $this->userRepository->create($input);
        $user->syncRoles($request->roles);

        $userDetail = ['user_id' => $user->id];

        if ($request->hasFile('image')) {
            $userDetail['image'] = FileHelper::s3Upload($input['image']);
        }
        $this->userDetailRepository->create($userDetail);

//        $roleIds  = array_keys(request()->role);

        sendRegisterUserEmail($user, 'Welcome to Our Platform - Your Account Details', $request->email, $request->password);
        $user->markEmailAsVerified();
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

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $roles = $this->getPossibleRoles(auth()->user());

        return view('users.edit')->with(['users' => $user, 'roles' => $roles]);
    }

    public function editUserProfile(Request $request)
    {
        $userId = $request->user()->id ?? null;
        $user  = $this->userRepository->find($userId);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $roles = $this->getPossibleRoles(auth()->user());

        return view('user_profile.edit')->with(['users' => $user, 'roles' => $roles]);
    }
    public function updateUserProfile(UpdateUserProfileRequest $request)
    {
        $userId = $request->user()->id ?? null;
        $user = $this->userRepository->find($userId);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->updateRecord($request, $userId);

        $userDetail = ['user_id' => $user->id];

        if ($request->hasFile('image')) {
            $userDetail['image'] = FileHelper::s3Upload($request->image);
        }
        $this->userDetailRepository->updateRecord($userDetail, $user);

        Flash::success('User updated successfully.');

        return redirect(route('user_profile.edit'));
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

        $user = $this->userRepository->updateRecord($request, $id);

        if(count($request->roles ?? []))
            $user->syncRoles($request->roles);

        $userDetail = ['user_id' => $user->id];

        if ($request->hasFile('image')) {
            $userDetail['image'] = FileHelper::s3Upload($request->image);
        }
        $this->userDetailRepository->updateRecord($userDetail, $user);

        Flash::success('User updated successfully.');

        if ($id == auth()->user()->id) {
            return redirect(route('users.edit', auth()->user()->id));
        }

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
