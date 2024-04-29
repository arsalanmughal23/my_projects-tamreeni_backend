<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Repositories\NutritionPlanRepository;
use App\Repositories\WorkoutPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Resources\NutritionPlanResource;
use App\Models\NutritionPlan;
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
    public function __construct(
        private UsersRepository $userRepository,
        private WorkoutPlanRepository $workoutPlanRepository,
        private NutritionPlanRepository $nutritionPlanRepository,
    ){}

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
            $userDetails = \Auth::user()->details;
            if (!$userDetails->goal) {
                return $this->sendError('Goal not set');
            }
            $workoutPlan   = $this->workoutPlanRepository->generateWorkoutPlan($userDetails);

            $nutritionPlan = $this->nutritionPlanRepository->generateNutritionPlan($userDetails);
            $nutritionPlan = NutritionPlan::with('nutritionPlanDays.nutritionPlanDayMeals')->find($nutritionPlan->id);
            $nutritionPlan = NutritionPlanResource::toObject($nutritionPlan);

            DB::commit();
            return $this->sendResponse(['workout_plan' => $workoutPlan->toArray(), 'nutrition_plan' => $nutritionPlan], 'Workout Plan generated successfully');
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->sendError($exception->getMessage());
        }
    }

    public function getPersonalStatistics(Request $request)
    {
        $user = $request->user();
        $userDetails = $user->details;
        $calculatedBMI = $userDetails->bmi;
        $responseData = [
            'bmi'       => $calculatedBMI,
            'bmi_description' => __('messages.bmi_description', ['bmi' => $calculatedBMI]),
            'user_details'      => $userDetails,
            'current_day_required_calories' => 200,
            'workout_week_count' => 4,
            'current_week_target_calroies' => 80,
            'current_week_consumed_calroies' => 20,
        ];

        return $this->sendResponse($responseData, 'Your personal statistics record');
    }
}
