<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserEventAPIRequest;
use App\Http\Requests\API\UpdateUserEventAPIRequest;
use App\Models\UserEvent;
use App\Repositories\UserEventRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserEventController
 * @package App\Http\Controllers\API
 */

class UserEventAPIController extends AppBaseController
{
    /** @var  UserEventRepository */
    private $userEventRepository;

    public function __construct(UserEventRepository $userEventRepo)
    {
        $this->userEventRepository = $userEventRepo;
    }

    /**
     * Display a listing of the UserEvent.
     * GET|HEAD /user_events
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_events = $this->userEventRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($user_events->toArray(), 'User Events retrieved successfully');
    }

    /**
     * Store a newly created UserEvent in storage.
     * POST /user_events
     *
     * @param CreateUserEventAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserEventAPIRequest $request)
    {
        $input = $request->all();

        $userEvent = $this->userEventRepository->create($input);

        return $this->sendResponse($userEvent->toArray(), 'User joined Event successfully');
    }

    /**
     * Display the specified UserEvent.
     * GET|HEAD /user_events/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserEvent $userEvent */
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            return $this->sendError('User Event not found');
        }

        return $this->sendResponse($userEvent->toArray(), 'User Event retrieved successfully');
    }

    /**
     * Update the specified UserEvent in storage.
     * PUT/PATCH /user_events/{id}
     *
     * @param int $id
     * @param UpdateUserEventAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserEventAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserEvent $userEvent */
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            return $this->sendError('User Event not found');
        }

        $userEvent = $this->userEventRepository->update($input, $id);

        return $this->sendResponse($userEvent->toArray(), 'UserEvent updated successfully');
    }

    /**
     * Remove the specified UserEvent from storage.
     * DELETE /user_events/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserEvent $userEvent */
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            return $this->sendError('User Event not found');
        }

        $userEvent->delete();

        return $this->sendSuccess('User Event deleted successfully');
    }

}
