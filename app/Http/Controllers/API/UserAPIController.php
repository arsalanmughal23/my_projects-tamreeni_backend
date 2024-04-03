<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Repositories\WorkoutPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\UserDetail;
use App\Repositories\UsersRepository;
use Error;
use Illuminate\Support\Facades\DB;
use Response;
use Config;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */
class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    private $workoutPlanRepository;

    public function __construct(UsersRepository $userRepo, WorkoutPlanRepository $workoutPlanRepo)
    {
        $this->userRepository        = $userRepo;
        $this->workoutPlanRepository = $workoutPlanRepo;
    }

    public function myProfile(Request $request)
    {
        try {
            /** @var User $user */
            $user = $request->user();

            return $this->sendResponse($user->toArray(), 'User profile data');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function updateProfile(UpdateUserAPIRequest $request)
    {
        try {
            /** @var User $user */
            $user        = $request->user();
            $phoneNumber = $request->get('phone_number', null);

            if (!$userDetails = $user->details)
                throw new Error('User Detail not found');

            if ($phoneNumber) {
                $isPhoneAlreadyExists = UserDetail::where('phone_number', $phoneNumber)
                    ->where('user_id', '!=', $user->id)
                    ->exists();

                if ($isPhoneAlreadyExists)
                    throw new Error('Phone number is already exists');
            }

            if ($request->name)
                $user->update(['name' => $request->name]);

            $userDetails->update($request->validated());

            return $this->sendResponse($user->fresh(), 'User profile is updated');

        } catch (\Error $e) {
            return $this->sendError($e->getMessage());
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /user
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $user    = $this->userRepository->getUsers($request->only('role', 'search', 'order', 'order_by'));

        // Paginate the results
        if ($request->get('paginate')) {
            $user = $user->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $user = $user->get();
        }

        return $this->sendResponse($user->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /user
     *
     * @param Request $request
     *
     * @return Response
     */

    // public function store(Request $request)
    // {
    //     $input = $request->all();

    //     $user = $this->userRepository->create($input);

    //     return $this->sendResponse($user->toArray(), 'User saved successfully');
    // }

    /**
     * Display the specified User.
     * GET|HEAD /user/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /user/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /user/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }

    public function generateWorkoutPlan()
    {
        try {
            DB::beginTransaction();
            $user = \Auth::user()->details;
            if (!$user->goal) {
                return $this->sendError('Goal not set');
            }
            $workoutPlan = $this->workoutPlanRepository->generateWorkoutPlan($user);
            DB::commit();
            return $this->sendResponse($workoutPlan->toArray(), 'Workout Plan generated successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            $this->sendError($exception->getMessage());
        }
    }
}
