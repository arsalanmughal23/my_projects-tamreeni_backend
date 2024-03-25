<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserSubscriptionAPIRequest;
use App\Http\Requests\API\UpdateUserSubscriptionAPIRequest;
use App\Models\UserSubscription;
use App\Repositories\UserSubscriptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserSubscriptionController
 * @package App\Http\Controllers\API
 */
class UserSubscriptionAPIController extends AppBaseController
{
    /** @var  UserSubscriptionRepository */
    private $userSubscriptionRepository;

    public function __construct(UserSubscriptionRepository $userSubscriptionRepo)
    {
        $this->userSubscriptionRepository = $userSubscriptionRepo;
    }

    /**
     * Display a listing of the UserSubscription.
     * GET|HEAD /user_subscriptions
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_subscriptions = $this->userSubscriptionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($user_subscriptions->toArray(), 'User Subscriptions retrieved successfully');
    }

    /**
     * Store a newly created UserSubscription in storage.
     * POST /user_subscriptions
     *
     * @param CreateUserSubscriptionAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserSubscriptionAPIRequest $request)
    {
        $input = $request->all();

        $userSubscription = $this->userSubscriptionRepository->create($input);

        return $this->sendResponse($userSubscription->toArray(), 'User Subscription saved successfully');
    }

    /**
     * Display the specified UserSubscription.
     * GET|HEAD /user_subscriptions/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserSubscription $userSubscription */
        $userSubscription = $this->userSubscriptionRepository->find($id);

        if (empty($userSubscription)) {
            return $this->sendError('User Subscription not found');
        }

        return $this->sendResponse($userSubscription->toArray(), 'User Subscription retrieved successfully');
    }

    /**
     * Update the specified UserSubscription in storage.
     * PUT/PATCH /user_subscriptions/{id}
     *
     * @param int $id
     * @param UpdateUserSubscriptionAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserSubscriptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserSubscription $userSubscription */
        $userSubscription = $this->userSubscriptionRepository->find($id);

        if (empty($userSubscription)) {
            return $this->sendError('User Subscription not found');
        }

        $userSubscription = $this->userSubscriptionRepository->update($input, $id);

        return $this->sendResponse($userSubscription->toArray(), 'UserSubscription updated successfully');
    }

    /**
     * Remove the specified UserSubscription from storage.
     * DELETE /user_subscriptions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserSubscription $userSubscription */
        $userSubscription = $this->userSubscriptionRepository->find($id);

        if (empty($userSubscription)) {
            return $this->sendError('User Subscription not found');
        }

        $userSubscription->delete();

        return $this->sendSuccess('User Subscription deleted successfully');
    }

    public function userCurrentPackage(Request $request)
    {

        $userSubscription = $this->userSubscriptionRepository->getCurrentPackage($request->user()->id);

        return $this->sendResponse($userSubscription, 'User Subscription retrieved successfully');

    }
}
