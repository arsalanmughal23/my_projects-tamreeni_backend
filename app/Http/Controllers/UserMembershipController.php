<?php

namespace App\Http\Controllers;

use App\DataTables\UserMembershipDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserMembershipRequest;
use App\Http\Requests\UpdateUserMembershipRequest;
use App\Repositories\UserMembershipRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserMembershipController extends AppBaseController
{
    /** @var UserMembershipRepository $userMembershipRepository*/
    private $userMembershipRepository;

    public function __construct(UserMembershipRepository $userMembershipRepo)
    {
        $this->userMembershipRepository = $userMembershipRepo;
    }

    /**
     * Display a listing of the UserMembership.
     *
     * @param UserMembershipDataTable $userMembershipDataTable
     *
     * @return Response
     */
    public function index(UserMembershipDataTable $userMembershipDataTable)
    {
        return $userMembershipDataTable->render('user_memberships.index');
    }

    /**
     * Show the form for creating a new UserMembership.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_memberships.create');
    }

    /**
     * Store a newly created UserMembership in storage.
     *
     * @param CreateUserMembershipRequest $request
     *
     * @return Response
     */
    public function store(CreateUserMembershipRequest $request)
    {
        $input = $request->all();

        $userMembership = $this->userMembershipRepository->create($input);

        Flash::success('User Membership saved successfully.');

        return redirect(route('user_memberships.index'));
    }

    /**
     * Display the specified UserMembership.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            Flash::error('User Membership not found');

            return redirect(route('user_memberships.index'));
        }

        return view('user_memberships.show')->with('userMembership', $userMembership);
    }

    /**
     * Show the form for editing the specified UserMembership.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            Flash::error('User Membership not found');

            return redirect(route('user_memberships.index'));
        }

        return view('user_memberships.edit')->with('userMembership', $userMembership);
    }

    /**
     * Update the specified UserMembership in storage.
     *
     * @param int $id
     * @param UpdateUserMembershipRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserMembershipRequest $request)
    {
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            Flash::error('User Membership not found');

            return redirect(route('user_memberships.index'));
        }

        $userMembership = $this->userMembershipRepository->update($request->all(), $id);

        Flash::success('User Membership updated successfully.');

        return redirect(route('user_memberships.index'));
    }

    /**
     * Remove the specified UserMembership from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userMembership = $this->userMembershipRepository->find($id);

        if (empty($userMembership)) {
            Flash::error('User Membership not found');

            return redirect(route('user_memberships.index'));
        }

        $this->userMembershipRepository->delete($id);

        Flash::success('User Membership deleted successfully.');

        return redirect(route('user_memberships.index'));
    }
}
