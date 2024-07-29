<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserMembershipAPIRequest;
use App\Http\Requests\API\UpdateUserMembershipAPIRequest;
use App\Models\UserMembership;
use App\Repositories\UserMembershipRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserMembershipController
 * @package App\Http\Controllers\API
 */

class UserMembershipAPIController extends AppBaseController
{
    /** @var  UserMembershipRepository */
    private $userMembershipRepository;

    public function __construct(UserMembershipRepository $userMembershipRepo)
    {
        $this->userMembershipRepository = $userMembershipRepo;
    }

    /**
     * Display a listing of the UserMembership.
     * GET|HEAD /user_memberships
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_memberships = $this->userMembershipRepository->all();

        return $this->sendResponse($user_memberships->toArray(), 'User Memberships retrieved successfully');
    }

    /**
     * Store a newly created UserMembership in storage.
     * POST /user_memberships
     *
     * @param CreateUserMembershipAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserMembershipAPIRequest $request)
    {
        $input = $request->all();

        $userMembership = $this->userMembershipRepository->create($input);

        return $this->sendResponse($userMembership->toArray(), 'User Membership saved successfully');
    }

    /**
     * Display the specified UserMembership.
     * GET|HEAD /user_memberships/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserMembership $userMembership */
        $userMembership = UserMembership::find($id);

        if (!$userMembership)
            return $this->sendError('User Membership not found');

        return $this->sendResponse($userMembership->toArray(), 'User Membership retrieved successfully');
    }

    /**
     * Update the specified UserMembership in storage.
     * PUT/PATCH /user_memberships/{id}
     *
     * @param int $id
     * @param UpdateUserMembershipAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserMembershipAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserMembership $userMembership */
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            return $this->sendError('User Membership not found');
        }

        $userMembership = $this->userMembershipRepository->update($input, $id);

        return $this->sendResponse($userMembership->toArray(), 'UserMembership updated successfully');
    }

    /**
     * Remove the specified UserMembership from storage.
     * DELETE /user_memberships/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserMembership $userMembership */
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            return $this->sendError('User Membership not found');
        }

        $userMembership->delete();

        return $this->sendSuccess('User Membership deleted successfully');
    }
}
