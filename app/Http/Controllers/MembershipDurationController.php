<?php

namespace App\Http\Controllers;

use App\DataTables\MembershipDurationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMembershipDurationRequest;
use App\Http\Requests\UpdateMembershipDurationRequest;
use App\Repositories\MembershipDurationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MembershipRepository;
use Response;

class MembershipDurationController extends AppBaseController
{
    /** @var MembershipDurationRepository $membershipDurationRepository*/

    public function __construct(
        public MembershipDurationRepository $membershipDurationRepository,
        public MembershipRepository $membershipRepository
    ) {}

    /**
     * Display a listing of the MembershipDuration.
     *
     * @param MembershipDurationDataTable $membershipDurationDataTable
     *
     * @return Response
     */
    public function index(MembershipDurationDataTable $membershipDurationDataTable)
    {
        return $membershipDurationDataTable->render('membership_durations.index');
    }

    /**
     * Show the form for creating a new MembershipDuration.
     *
     * @return Response
     */
    public function create()
    {
        $memberships = $this->membershipRepository->getRecords(['status' => 'active'])->get();
        return view('membership_durations.create', compact('memberships'));
    }

    /**
     * Store a newly created MembershipDuration in storage.
     *
     * @param CreateMembershipDurationRequest $request
     *
     * @return Response
     */
    public function store(CreateMembershipDurationRequest $request)
    {
        $input = $request->all();

        $membershipDuration = $this->membershipDurationRepository->create($input);

        Flash::success('Membership Duration saved successfully.');

        return redirect(route('membership_durations.index'));
    }

    /**
     * Display the specified MembershipDuration.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            Flash::error('Membership Duration not found');

            return redirect(route('membership_durations.index'));
        }

        return view('membership_durations.show')->with('membershipDuration', $membershipDuration);
    }

    /**
     * Show the form for editing the specified MembershipDuration.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $membershipDuration = $this->membershipDurationRepository->find($id);
        $memberships = $this->membershipRepository->getRecords(['status' => 'active'])->get();

        if (empty($membershipDuration)) {
            Flash::error('Membership Duration not found');

            return redirect(route('membership_durations.index'));
        }

        return view('membership_durations.edit', compact('membershipDuration', 'memberships'));
    }

    /**
     * Update the specified MembershipDuration in storage.
     *
     * @param int $id
     * @param UpdateMembershipDurationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMembershipDurationRequest $request)
    {
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            Flash::error('Membership Duration not found');

            return redirect(route('membership_durations.index'));
        }

        $membershipDuration = $this->membershipDurationRepository->update($request->all(), $id);

        Flash::success('Membership Duration updated successfully.');

        return redirect(route('membership_durations.index'));
    }

    /**
     * Remove the specified MembershipDuration from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $membershipDuration = $this->membershipDurationRepository->find($id);

        if (empty($membershipDuration)) {
            Flash::error('Membership Duration not found');

            return redirect(route('membership_durations.index'));
        }

        $this->membershipDurationRepository->delete($id);

        Flash::success('Membership Duration deleted successfully.');

        return redirect(route('membership_durations.index'));
    }
}
