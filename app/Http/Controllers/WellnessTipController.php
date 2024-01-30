<?php

namespace App\Http\Controllers;

use App\DataTables\WellnessTipDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWellnessTipRequest;
use App\Http\Requests\UpdateWellnessTipRequest;
use App\Repositories\WellnessTipRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WellnessTipController extends AppBaseController
{
    /** @var WellnessTipRepository $wellnessTipRepository*/
    private $wellnessTipRepository;

    public function __construct(WellnessTipRepository $wellnessTipRepo)
    {
        $this->wellnessTipRepository = $wellnessTipRepo;
    }

    /**
     * Display a listing of the WellnessTip.
     *
     * @param WellnessTipDataTable $wellnessTipDataTable
     *
     * @return Response
     */
    public function index(WellnessTipDataTable $wellnessTipDataTable)
    {
        return $wellnessTipDataTable->render('wellness_tips.index');
    }

    /**
     * Show the form for creating a new WellnessTip.
     *
     * @return Response
     */
    public function create()
    {
        return view('wellness_tips.create');
    }

    /**
     * Store a newly created WellnessTip in storage.
     *
     * @param CreateWellnessTipRequest $request
     *
     * @return Response
     */
    public function store(CreateWellnessTipRequest $request)
    {
        $input = $request->all();

        $wellnessTip = $this->wellnessTipRepository->create($input);

        Flash::success('Wellness Tip saved successfully.');

        return redirect(route('wellness_tips.index'));
    }

    /**
     * Display the specified WellnessTip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            Flash::error('Wellness Tip not found');

            return redirect(route('wellness_tips.index'));
        }

        return view('wellness_tips.show')->with('wellnessTip', $wellnessTip);
    }

    /**
     * Show the form for editing the specified WellnessTip.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            Flash::error('Wellness Tip not found');

            return redirect(route('wellness_tips.index'));
        }

        return view('wellness_tips.edit')->with('wellnessTip', $wellnessTip);
    }

    /**
     * Update the specified WellnessTip in storage.
     *
     * @param int $id
     * @param UpdateWellnessTipRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWellnessTipRequest $request)
    {
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            Flash::error('Wellness Tip not found');

            return redirect(route('wellness_tips.index'));
        }

        $wellnessTip = $this->wellnessTipRepository->update($request->all(), $id);

        Flash::success('Wellness Tip updated successfully.');

        return redirect(route('wellness_tips.index'));
    }

    /**
     * Remove the specified WellnessTip from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $wellnessTip = $this->wellnessTipRepository->find($id);

        if (empty($wellnessTip)) {
            Flash::error('Wellness Tip not found');

            return redirect(route('wellness_tips.index'));
        }

        $this->wellnessTipRepository->delete($id);

        Flash::success('Wellness Tip deleted successfully.');

        return redirect(route('wellness_tips.index'));
    }
}
