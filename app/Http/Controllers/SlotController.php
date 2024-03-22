<?php

namespace App\Http\Controllers;

use App\DataTables\SlotDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSlotRequest;
use App\Http\Requests\UpdateSlotRequest;
use App\Repositories\SlotRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SlotController extends AppBaseController
{
    /** @var SlotRepository $slotRepository*/
    private $slotRepository;

    public function __construct(SlotRepository $slotRepo)
    {
        $this->slotRepository = $slotRepo;
    }

    /**
     * Display a listing of the Slot.
     *
     * @param SlotDataTable $slotDataTable
     *
     * @return Response
     */
    public function index(SlotDataTable $slotDataTable)
    {
        return $slotDataTable->render('slots.index');
    }

    /**
     * Show the form for creating a new Slot.
     *
     * @return Response
     */
    public function create()
    {
        return view('slots.create');
    }

    /**
     * Store a newly created Slot in storage.
     *
     * @param CreateSlotRequest $request
     *
     * @return Response
     */
    public function store(CreateSlotRequest $request)
    {
        $input = $request->all();

        $slot = $this->slotRepository->create($input);

        Flash::success('Slot saved successfully.');

        return redirect(route('slots.index'));
    }

    /**
     * Display the specified Slot.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            Flash::error('Slot not found');

            return redirect(route('slots.index'));
        }

        return view('slots.show')->with('slot', $slot);
    }

    /**
     * Show the form for editing the specified Slot.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            Flash::error('Slot not found');

            return redirect(route('slots.index'));
        }

        return view('slots.edit')->with('slot', $slot);
    }

    /**
     * Update the specified Slot in storage.
     *
     * @param int $id
     * @param UpdateSlotRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSlotRequest $request)
    {
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            Flash::error('Slot not found');

            return redirect(route('slots.index'));
        }

        $slot = $this->slotRepository->update($request->all(), $id);

        Flash::success('Slot updated successfully.');

        return redirect(route('slots.index'));
    }

    /**
     * Remove the specified Slot from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            Flash::error('Slot not found');

            return redirect(route('slots.index'));
        }

        $this->slotRepository->delete($id);

        Flash::success('Slot deleted successfully.');

        return redirect(route('slots.index'));
    }
}
