<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserSocialAccountAPIRequest;
use App\Http\Requests\API\UpdateUserSocialAccountAPIRequest;
use App\Models\UserSocialAccount;
use App\Repositories\UserSocialAccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserSocialAccountController
 * @package App\Http\Controllers\API
 */

class UserSocialAccountAPIController extends AppBaseController
{
    /** @var  UserSocialAccountRepository */
    private $userSocialAccountRepository;

    public function __construct(UserSocialAccountRepository $userSocialAccountRepo)
    {
        $this->userSocialAccountRepository = $userSocialAccountRepo;
    }

    /**
     * Display a listing of the UserSocialAccount.
     * GET|HEAD /user_social_accounts
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_social_accounts = $this->userSocialAccountRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($user_social_accounts->toArray(), 'User Social Accounts retrieved successfully');
    }

    /**
     * Store a newly created UserSocialAccount in storage.
     * POST /user_social_accounts
     *
     * @param CreateUserSocialAccountAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserSocialAccountAPIRequest $request)
    {
        $input = $request->all();

        $userSocialAccount = $this->userSocialAccountRepository->create($input);

        return $this->sendResponse($userSocialAccount->toArray(), 'User Social Account saved successfully');
    }

    /**
     * Display the specified UserSocialAccount.
     * GET|HEAD /user_social_accounts/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserSocialAccount $userSocialAccount */
        $userSocialAccount = $this->userSocialAccountRepository->find($id);

        if (empty($userSocialAccount)) {
            return $this->sendError('User Social Account not found');
        }

        return $this->sendResponse($userSocialAccount->toArray(), 'User Social Account retrieved successfully');
    }

    /**
     * Update the specified UserSocialAccount in storage.
     * PUT/PATCH /user_social_accounts/{id}
     *
     * @param int $id
     * @param UpdateUserSocialAccountAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserSocialAccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserSocialAccount $userSocialAccount */
        $userSocialAccount = $this->userSocialAccountRepository->find($id);

        if (empty($userSocialAccount)) {
            return $this->sendError('User Social Account not found');
        }

        $userSocialAccount = $this->userSocialAccountRepository->update($input, $id);

        return $this->sendResponse($userSocialAccount->toArray(), 'UserSocialAccount updated successfully');
    }

    /**
     * Remove the specified UserSocialAccount from storage.
     * DELETE /user_social_accounts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserSocialAccount $userSocialAccount */
        $userSocialAccount = $this->userSocialAccountRepository->find($id);

        if (empty($userSocialAccount)) {
            return $this->sendError('User Social Account not found');
        }

        $userSocialAccount->delete();

        return $this->sendSuccess('User Social Account deleted successfully');
    }
}
