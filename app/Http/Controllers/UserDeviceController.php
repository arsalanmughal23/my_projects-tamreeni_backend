<?php

namespace App\Http\Controllers;

use App\DataTables\UserDeviceDataTable;
use Illuminate\Http\Request;
use App\Repositories\UserDeviceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UserDeviceController extends AppBaseController
{
    /** @var UserDeviceRepository $userDeviceRepository*/
    private $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepo)
    {
        $this->userDeviceRepository = $userDeviceRepo;
    }

    /**
     * Display a listing of the UserDevice.
     *
     * @param UserDeviceDataTable $userDeviceDataTable
     *
     * @return Response
     */
    public function index(UserDeviceDataTable $userDeviceDataTable)
    {
        return $userDeviceDataTable->render('user_devices.index');
    }

    /**
     * Show the form for creating a new UserDevice.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_devices.create');
    }

    /**
     * Store a newly created UserDevice in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $userDevice = $this->userDeviceRepository->create($input);

        Flash::success('User Device saved successfully.');

        return redirect(route('user_devices.index'));
    }

    /**
     * Display the specified UserDevice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('user_devices.index'));
        }

        return view('user_devices.show')->with('userDevice', $userDevice);
    }

    /**
     * Show the form for editing the specified UserDevice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('user_devices.index'));
        }

        return view('user_devices.edit')->with('userDevice', $userDevice);
    }

    /**
     * Update the specified UserDevice in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('user_devices.index'));
        }

        $userDevice = $this->userDeviceRepository->update($request->all(), $id);

        Flash::success('User Device updated successfully.');

        return redirect(route('user_devices.index'));
    }

    /**
     * Remove the specified UserDevice from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('user_devices.index'));
        }

        $this->userDeviceRepository->delete($id);

        Flash::success('User Device deleted successfully.');

        return redirect(route('user_devices.index'));
    }
}
