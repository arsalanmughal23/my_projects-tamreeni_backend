<?php

namespace App\Http\Controllers;

use App\DataTables\ContactRequestDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateContactRequestRequest;
use App\Http\Requests\UpdateContactRequestRequest;
use App\Repositories\ContactRequestRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ContactRequestController extends AppBaseController
{
    /** @var ContactRequestRepository $contactRequestRepository*/
    private $contactRequestRepository;

    public function __construct(ContactRequestRepository $contactRequestRepo)
    {
        $this->contactRequestRepository = $contactRequestRepo;
    }

    /**
     * Display a listing of the ContactRequest.
     *
     * @param ContactRequestDataTable $contactRequestDataTable
     *
     * @return Response
     */
    public function index(ContactRequestDataTable $contactRequestDataTable)
    {
        return $contactRequestDataTable->render('contact_requests.index');
    }

    /**
     * Show the form for creating a new ContactRequest.
     *
     * @return Response
     */
    public function create()
    {
        return view('contact_requests.create');
    }

    /**
     * Store a newly created ContactRequest in storage.
     *
     * @param CreateContactRequestRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequestRequest $request)
    {
        $input = $request->all();

        $contactRequest = $this->contactRequestRepository->create($input);

        Flash::success('Contact Request saved successfully.');

        return redirect(route('contact_requests.index'));
    }

    /**
     * Display the specified ContactRequest.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            Flash::error('Contact Request not found');

            return redirect(route('contact_requests.index'));
        }

        return view('contact_requests.show')->with('contactRequest', $contactRequest);
    }

    /**
     * Show the form for editing the specified ContactRequest.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            Flash::error('Contact Request not found');

            return redirect(route('contact_requests.index'));
        }

        return view('contact_requests.edit')->with('contactRequest', $contactRequest);
    }

    /**
     * Update the specified ContactRequest in storage.
     *
     * @param int $id
     * @param UpdateContactRequestRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequestRequest $request)
    {
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            Flash::error('Contact Request not found');

            return redirect(route('contact_requests.index'));
        }

        $contactRequest = $this->contactRequestRepository->update($request->all(), $id);

        Flash::success('Contact Request updated successfully.');

        return redirect(route('contact_requests.index'));
    }

    /**
     * Remove the specified ContactRequest from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contactRequest = $this->contactRequestRepository->find($id);

        if (empty($contactRequest)) {
            Flash::error('Contact Request not found');

            return redirect(route('contact_requests.index'));
        }

        $this->contactRequestRepository->delete($id);

        Flash::success('Contact Request deleted successfully.');

        return redirect(route('contact_requests.index'));
    }
}
