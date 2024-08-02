<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Repositories\AppointmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Role;
use App\Repositories\UsersRepository;
use Response;

class AppointmentController extends AppBaseController
{
    /** @var AppointmentRepository $appointmentRepository*/

    public function __construct(
        private AppointmentRepository $appointmentRepository,
        private UsersRepository $userRepository,
    ) {}

    public function getSelectOptionData()
    {
        return [
            'users' => $this->userRepository->getUsers(['role_names' => Role::MENTOR])->get(),
            'customers' => $this->userRepository->getUsers(['role_names' => [Role::API_USER]])->get(),
        ];
    }

    /**
     * Display a listing of the Appointment.
     *
     * @param AppointmentDataTable $appointmentDataTable
     *
     * @return Response
     */
    public function index(AppointmentDataTable $appointmentDataTable)
    {
        return $appointmentDataTable->render('appointments.index');
    }

    /**
     * Show the form for creating a new Appointment.
     *
     * @return Response
     */
    public function create()
    {
        $users = $this->getSelectOptionData();
        return view('appointments.create', compact('users'));
    }

    /**
     * Store a newly created Appointment in storage.
     *
     * @param CreateAppointmentRequest $request
     *
     * @return Response
     */
    public function store(CreateAppointmentRequest $request)
    {
        $input = $request->all();

        $appointment = $this->appointmentRepository->create($input);

        Flash::success('Appointment saved successfully.');

        return redirect(route('appointments.index'));
    }

    /**
     * Display the specified Appointment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        return view('appointments.show')->with('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified Appointment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        $users = $this->getSelectOptionData();
        return view('appointments.edit', compact('appointment', 'users'));
    }

    /**
     * Update the specified Appointment in storage.
     *
     * @param int $id
     * @param UpdateAppointmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppointmentRequest $request)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        $appointment = $this->appointmentRepository->update($request->all(), $id);

        Flash::success('Appointment updated successfully.');

        return redirect(route('appointments.index'));
    }

    /**
     * Remove the specified Appointment from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        $this->appointmentRepository->delete($id);

        Flash::success('Appointment deleted successfully.');

        return redirect(route('appointments.index'));
    }
}
