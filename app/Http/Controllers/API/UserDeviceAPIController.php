<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserDeviceAPIRequest;
use App\Http\Requests\API\UpdateUserDeviceAPIRequest;
use App\Models\UserDevice;
use App\Repositories\UserDeviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserDeviceController
 * @package App\Http\Controllers\API
 */

class UserDeviceAPIController extends AppBaseController
{
    /** @var  UserDeviceRepository */
    private $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepo)
    {
        $this->userDeviceRepository = $userDeviceRepo;
    }

    /**
     * Display a listing of the UserDevice.
     * GET|HEAD /user_devices
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $user_devices = $this->userDeviceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($user_devices->toArray(), 'User Devices retrieved successfully');
    }

    /**
     * Store a newly created UserDevice in storage.
     * POST /user_devices
     *
     * @param CreateUserDeviceAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateUserDeviceAPIRequest $request)
    {
        $input = $request->all();

        $userDevice = $this->userDeviceRepository->create($input);

        return $this->sendResponse($userDevice->toArray(), 'User Device saved successfully');
    }

    /**
     * Display the specified UserDevice.
     * GET|HEAD /user_devices/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var UserDevice $userDevice */
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            return $this->sendError('User Device not found');
        }

        return $this->sendResponse($userDevice->toArray(), 'User Device retrieved successfully');
    }

    /**
     * Update the specified UserDevice in storage.
     * PUT/PATCH /user_devices/{id}
     *
     * @param int $id
     * @param UpdateUserDeviceAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateUserDeviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserDevice $userDevice */
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            return $this->sendError('User Device not found');
        }

        $userDevice = $this->userDeviceRepository->update($input, $id);

        return $this->sendResponse($userDevice->toArray(), 'UserDevice updated successfully');
    }

    /**
     * Remove the specified UserDevice from storage.
     * DELETE /user_devices/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var UserDevice $userDevice */
        $userDevice = $this->userDeviceRepository->find($id);

        if (empty($userDevice)) {
            return $this->sendError('User Device not found');
        }

        $userDevice->delete();

        return $this->sendSuccess('User Device deleted successfully');
    }
}
