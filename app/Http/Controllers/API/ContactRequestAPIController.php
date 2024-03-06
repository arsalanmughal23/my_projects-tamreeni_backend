<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContactRequestAPIRequest;
use App\Http\Requests\API\UpdateContactRequestAPIRequest;
use App\Models\ContactRequest;
use App\Repositories\ContactRequestRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ContactRequestController
 * @package App\Http\Controllers\API
 */

class ContactRequestAPIController extends AppBaseController
{
    /** @var  ContactRequestRepository */
    private $contactRequestRepository;

    public function __construct(ContactRequestRepository $contactRequestRepo)
    {
        $this->contactRequestRepository = $contactRequestRepo;
    }

    /**
     * Display a listing of the ContactRequest.
     * GET|HEAD /contact_requests
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $contact_requests = $this->contactRequestRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($contact_requests->toArray(), 'Contact Requests retrieved successfully');
    }

    /**
     * Store a newly created ContactRequest in storage.
     * POST /contact_requests
     *
     * @param CreateContactRequestAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateContactRequestAPIRequest $request)
    {
        $input = $request->all();

        $contactRequest = $this->contactRequestRepository->create($input);

        return $this->sendResponse($contactRequest->toArray(), 'Contact Request saved successfully');
    }

    /**
     * Display the specified ContactRequest.
     * GET|HEAD /contact_requests/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var ContactRequest $contactRequest */
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            return $this->sendError('Contact Request not found');
        }

        return $this->sendResponse($contactRequest->toArray(), 'Contact Request retrieved successfully');
    }

    /**
     * Update the specified ContactRequest in storage.
     * PUT/PATCH /contact_requests/{id}
     *
     * @param int $id
     * @param UpdateContactRequestAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateContactRequestAPIRequest $request)
    {
        $input = $request->all();

        /** @var ContactRequest $contactRequest */
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            return $this->sendError('Contact Request not found');
        }

        $contactRequest = $this->contactRequestRepository->update($input, $id);

        return $this->sendResponse($contactRequest->toArray(), 'ContactRequest updated successfully');
    }

    /**
     * Remove the specified ContactRequest from storage.
     * DELETE /contact_requests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var ContactRequest $contactRequest */
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            return $this->sendError('Contact Request not found');
        }

        $contactRequest->delete();

        return $this->sendSuccess('Contact Request deleted successfully');
    }
}
