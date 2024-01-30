<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserDetailAPIRequest;
use App\Http\Requests\API\UpdateUserDetailAPIRequest;
use App\Models\UserDetail;
use App\Models\User;
use App\Repositories\UserDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserDetailController
 * @package App\Http\Controllers\API
 */

class UserDetailAPIController extends AppBaseController
{
    /** @var  UserDetailRepository */
    private $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepo)
    {
        $this->userDetailRepository = $userDetailRepo;
    }

    /**
     * Display a listing of the UserDetail.
     * GET|HEAD /user_details
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_details = $this->userDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($user_details->toArray(), 'User Details retrieved successfully');
    }

    /**
     * Store a newly created UserDetail in storage.
     * POST /user_details
     *
     * @param CreateUserDetailAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserDetailAPIRequest $request)
    {
        $input = $request->all();

        $userDetail = $this->userDetailRepository->create($input);

        return $this->sendResponse($userDetail->toArray(), 'User Detail saved successfully');
    }

    /**
     * Display the specified UserDetail.
     * GET|HEAD /user_details/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserDetail $userDetail */
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            return $this->sendError('User Detail not found');
        }

        return $this->sendResponse($userDetail->toArray(), 'User Detail retrieved successfully');
    }

    /**
     * Update the specified UserDetail in storage.
     * PUT/PATCH /user_details/{id}
     *
     * @param int $id
     * @param UpdateUserDetailAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserDetail $userDetail */
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            return $this->sendError('User Detail not found');
        }

        $userDetail = $this->userDetailRepository->update($input, $id);

        return $this->sendResponse($userDetail->toArray(), 'UserDetail updated successfully');
    }

    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:en,ar',
        ]);

        $user = auth()->user();
        $user->details()->update(['language' => $request->language]);
        $userDetails = $user->details;

        return $this->sendResponse($userDetails->toArray(), 'Language updated successfully');
    }

    public function getUserProfile()
    {
        $user = auth()->user();
        $userDetails = $user->details;
        $userDetails->email = $user->email;
        return $this->sendResponse($userDetails->toArray(), 'User profile retrieved successfully');
    }

    /**
     * Remove the specified UserDetail from storage.
     * DELETE /user_details/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserDetail $userDetail */
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            return $this->sendError('User Detail not found');
        }

        $userDetail->delete();

        return $this->sendSuccess('User Detail deleted successfully');
    }
}
