<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMembershipAPIRequest;
use App\Http\Requests\API\UpdateMembershipAPIRequest;
use App\Models\Membership;
use App\Repositories\MembershipRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MembershipResource;
use Response;

/**
 * Class MembershipController
 * @package App\Http\Controllers\API
 */

class MembershipAPIController extends AppBaseController
{
    /** @var  MembershipRepository */
    private $membershipRepository;

    public function __construct(MembershipRepository $membershipRepo)
    {
        $this->membershipRepository = $membershipRepo;
    }

    /**
     * Display a listing of the Membership.
     * GET|HEAD /memberships
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $memberships = $this->membershipRepository->getRecords($request->only('title'))
                            ->where('status', Membership::CONST_STATUS_ACTIVE)
                            ->get();

        return $this->sendResponse(MembershipResource::collection($memberships), 'Memberships retrieved successfully');
    }

    /**
     * Store a newly created Membership in storage.
     * POST /memberships
     *
     * @param CreateMembershipAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateMembershipAPIRequest $request)
    {
        $input = $request->all();

        $membership = $this->membershipRepository->create($input);

        return $this->sendResponse($membership->toArray(), 'Membership saved successfully');
    }

    /**
     * Display the specified Membership.
     * GET|HEAD /memberships/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Membership $membership */
        $membership = $this->membershipRepository->find($id);

        if (empty($membership)) {
            return $this->sendError('Membership not found');
        }

        return $this->sendResponse($membership->toArray(), 'Membership retrieved successfully');
    }

    /**
     * Update the specified Membership in storage.
     * PUT/PATCH /memberships/{id}
     *
     * @param int $id
     * @param UpdateMembershipAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateMembershipAPIRequest $request)
    {
        $input = $request->all();

        /** @var Membership $membership */
        $membership = $this->membershipRepository->find($id);

        if (empty($membership)) {
            return $this->sendError('Membership not found');
        }

        $membership = $this->membershipRepository->update($input, $id);

        return $this->sendResponse($membership->toArray(), 'Membership updated successfully');
    }

    /**
     * Remove the specified Membership from storage.
     * DELETE /memberships/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Membership $membership */
        $membership = $this->membershipRepository->find($id);

        if (empty($membership)) {
            return $this->sendError('Membership not found');
        }

        $membership->delete();

        return $this->sendSuccess('Membership deleted successfully');
    }
}
