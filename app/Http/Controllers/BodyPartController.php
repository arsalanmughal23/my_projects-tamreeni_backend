<?php

namespace App\Http\Controllers;

use App\DataTables\BodyPartDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBodyPartRequest;
use App\Http\Requests\UpdateBodyPartRequest;
use App\Repositories\BodyPartRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BodyPartController extends AppBaseController
{
    /** @var BodyPartRepository $bodyPartRepository*/
    private $bodyPartRepository;

    public function __construct(BodyPartRepository $bodyPartRepo)
    {
        $this->bodyPartRepository = $bodyPartRepo;
    }

    /**
     * Display a listing of the BodyPart.
     *
     * @param BodyPartDataTable $bodyPartDataTable
     *
     * @return Response
     */
    public function index(BodyPartDataTable $bodyPartDataTable)
    {
        return $bodyPartDataTable->render('body_parts.index');
    }

    /**
     * Show the form for creating a new BodyPart.
     *
     * @return Response
     */
    public function create()
    {
        return view('body_parts.create');
    }

    /**
     * Store a newly created BodyPart in storage.
     *
     * @param CreateBodyPartRequest $request
     *
     * @return Response
     */
    public function store(CreateBodyPartRequest $request)
    {
        $input = $request->all();

        $bodyPart = $this->bodyPartRepository->create($input);

        Flash::success('Body Part saved successfully.');

        return redirect(route('body_parts.index'));
    }

    /**
     * Display the specified BodyPart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            Flash::error('Body Part not found');

            return redirect(route('body_parts.index'));
        }

        return view('body_parts.show')->with('bodyPart', $bodyPart);
    }

    /**
     * Show the form for editing the specified BodyPart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            Flash::error('Body Part not found');

            return redirect(route('body_parts.index'));
        }

        return view('body_parts.edit')->with('bodyPart', $bodyPart);
    }

    /**
     * Update the specified BodyPart in storage.
     *
     * @param int $id
     * @param UpdateBodyPartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBodyPartRequest $request)
    {
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            Flash::error('Body Part not found');

            return redirect(route('body_parts.index'));
        }

        $bodyPart = $this->bodyPartRepository->update($request->all(), $id);

        Flash::success('Body Part updated successfully.');

        return redirect(route('body_parts.index'));
    }

    /**
     * Remove the specified BodyPart from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bodyPart = $this->bodyPartRepository->find($id);

        if (empty($bodyPart)) {
            Flash::error('Body Part not found');

            return redirect(route('body_parts.index'));
        }

        $this->bodyPartRepository->delete($id);

        Flash::success('Body Part deleted successfully.');

        return redirect(route('body_parts.index'));
    }
}
