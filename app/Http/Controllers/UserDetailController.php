<?php

namespace App\Http\Controllers;

use App\DataTables\UserDetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Repositories\UserDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserDetailController extends AppBaseController
{
    /** @var UserDetailRepository $userDetailRepository*/
    private $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepo)
    {
        $this->userDetailRepository = $userDetailRepo;
    }

    /**
     * Display a listing of the UserDetail.
     *
     * @param UserDetailDataTable $userDetailDataTable
     *
     * @return Response
     */
    public function index(UserDetailDataTable $userDetailDataTable)
    {
        return $userDetailDataTable->render('user_details.index');
    }

    /**
     * Show the form for creating a new UserDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_details.create');
    }

    /**
     * Store a newly created UserDetail in storage.
     *
     * @param CreateUserDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDetailRequest $request)
    {
        $input = $request->all();

        $userDetail = $this->userDetailRepository->create($input);

        Flash::success('User Detail saved successfully.');

        return redirect(route('user_details.index'));
    }

    /**
     * Display the specified UserDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        return view('user_details.show')->with('userDetail', $userDetail);
    }

    /**
     * Show the form for editing the specified UserDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        return view('user_details.edit')->with('userDetail', $userDetail);
    }

    /**
     * Update the specified UserDetail in storage.
     *
     * @param int $id
     * @param UpdateUserDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDetailRequest $request)
    {
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        $userDetail = $this->userDetailRepository->update($request->all(), $id);

        Flash::success('User Detail updated successfully.');

        return redirect(route('user_details.index'));
    }

    /**
     * Remove the specified UserDetail from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userDetail = $this->userDetailRepository->find($id);

        if (empty($userDetail)) {
            Flash::error('User Detail not found');

            return redirect(route('user_details.index'));
        }

        $this->userDetailRepository->delete($id);

        Flash::success('User Detail deleted successfully.');

        return redirect(route('user_details.index'));
    }
}
