<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMembershipDurationAPIRequest;
use App\Http\Requests\API\UpdateMembershipDurationAPIRequest;
use App\Models\MembershipDuration;
use App\Repositories\MembershipDurationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MembershipDurationController
 * @package App\Http\Controllers\API
 */

class MembershipDurationAPIController extends AppBaseController
{
    /** @var  MembershipDurationRepository */
    private $membershipDurationRepository;

    public function __construct(MembershipDurationRepository $membershipDurationRepo)
    {
        $this->membershipDurationRepository = $membershipDurationRepo;
    }

    /**
     * Display a listing of the MembershipDuration.
     * GET|HEAD /membership_durations
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $membership_durations = $this->membershipDurationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($membership_durations->toArray(), 'Membership Durations retrieved successfully');
    }

    /**
     * Store a newly created MembershipDuration in storage.
     * POST /membership_durations
     *
     * @param CreateMembershipDurationAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMembershipDurationAPIRequest $request)
    {
        $input = $request->all();

        $membershipDuration = $this->membershipDurationRepository->create($input);

        return $this->sendResponse($membershipDuration->toArray(), 'Membership Duration saved successfully');
    }

    /**
     * Display the specified MembershipDuration.
     * GET|HEAD /membership_durations/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var MembershipDuration $membershipDuration */
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            return $this->sendError('Membership Duration not found');
        }

        return $this->sendResponse($membershipDuration->toArray(), 'Membership Duration retrieved successfully');
    }

    /**
     * Update the specified MembershipDuration in storage.
     * PUT/PATCH /membership_durations/{id}
     *
     * @param int $id
     * @param UpdateMembershipDurationAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMembershipDurationAPIRequest $request)
    {
        $input = $request->all();

        /** @var MembershipDuration $membershipDuration */
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            return $this->sendError('Membership Duration not found');
        }

        $membershipDuration = $this->membershipDurationRepository->update($input, $id);

        return $this->sendResponse($membershipDuration->toArray(), 'MembershipDuration updated successfully');
    }

    /**
     * Remove the specified MembershipDuration from storage.
     * DELETE /membership_durations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var MembershipDuration $membershipDuration */
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            return $this->sendError('Membership Duration not found');
        }

        $membershipDuration->delete();

        return $this->sendSuccess('Membership Duration deleted successfully');
    }
}
