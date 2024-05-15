<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Repositories\NutritionPlanRepository;
use App\Repositories\WorkoutPlanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Resources\NutritionPlanResource;
use App\Http\Resources\WorkoutPlanResource;
use App\Models\NutritionPlan;
use App\Models\UserDetail;
use App\Models\WorkoutPlan;
use App\Repositories\UserDetailRepository;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
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
        private UserDetailRepository $userDetailRepository,
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

    public function generatePlans()
    {
        try {
            DB::beginTransaction();
            $user = \Auth::user();
            $userDetails = $user->details;
            if (!$userDetails->goal) {
                return $this->sendError('Goal not set');
            }

            // Set Nutrition Plan Start & End Date
            $planStartDate  = Carbon::now();
            $planEndDate    = Carbon::parse($userDetails->reach_goal_target_date);

            if(!$userDetails->is_last_attempt_plan_generated)
                $userDetails = $this->userDetailRepository->updateRecord(['algo_required_calories' => calculateRequiredCalories($userDetails)], $user);

            $workoutPlan    = $this->workoutPlanRepository->generateWorkoutPlan($userDetails, $planStartDate, $planEndDate);
            $nutritionPlan  = $this->nutritionPlanRepository->generateNutritionPlan($userDetails, $planStartDate, $planEndDate);

            if($workoutPlan)
                $workoutPlan = new WorkoutPlanResource(WorkoutPlan::with('workoutPlanDays.workoutDayExercises')->find($workoutPlan->id));
            if($nutritionPlan)
                $nutritionPlan = new NutritionPlanResource(NutritionPlan::with('nutritionPlanDays.nutritionPlanDayMeals')->find($nutritionPlan->id));

            $this->userDetailRepository->updatedStatusPlanIsGenerated($userDetails, 1);

            $message = ($workoutPlan || $nutritionPlan) ? 'Your plan is generated successfully' : 'Sorry, your plan is not generated';

            DB::commit();
            return $this->sendResponse(['workout_plan' => $workoutPlan, 'nutrition_plan' => $nutritionPlan], $message);
        } catch (\Error $error) {
            DB::rollback();
            return $this->sendError($error->getMessage());
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
