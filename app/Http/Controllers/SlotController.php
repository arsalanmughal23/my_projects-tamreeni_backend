<?php

namespace App\Http\Controllers;

use App\DataTables\SlotDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSlotRequest;
use App\Http\Requests\UpdateSlotRequest;
use App\Repositories\SlotRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Role;
use App\Models\Slot;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
use Error;
use Response;

class SlotController extends AppBaseController
{
    /** @var SlotRepository $slotRepository*/
    public function __construct(
        private SlotRepository $slotRepository,
        private UsersRepository $userRepository
    ) {}

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
        $users = $this->userRepository->getUsers(['role_names' => Role::MENTOR])->pluck('name', 'id');
        $daysSelectOptions = $this->slotRepository->getDaysSelectOptions();
        $slotTypesSelectOptions = $this->slotRepository->getTypeSelectOptions();
        return view('slots.create', compact('users', 'daysSelectOptions', 'slotTypesSelectOptions'));
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
        try {
            $input = $request->all();

            $startTime = Carbon::parse($request->start_time);
            $endTime = Carbon::parse($request->end_time);

            if(!$startTime->isBefore($endTime))
                throw new Error('Shift start time should before end time');

            $shiftTimeLimit = Slot::SHIFT_TIME_LIMITS[$request->type];
            [$shiftStartAfter, $shiftEndBefore] = $shiftTimeLimit;
            if (!$startTime->between($shiftStartAfter, $shiftEndBefore) || !$endTime->between($shiftStartAfter, $shiftEndBefore))
                throw new Error('Shift start & end time must between '.$shiftStartAfter.' - '.$shiftEndBefore);

            $slotExists = $this->slotRepository->getBusySlotsDuringTimeDuration($startTime, $endTime)
                ->where([
                    'user_id' => $request->user_id,
                    'day' => $request->day,
                    'type' => $request->type
                ])
                ->exists();

            if ($slotExists)
                throw new Error('Slot is already exists during your selected duration');

            $slot = $this->slotRepository->create($input);

            Flash::success('Slot saved successfully.');

            return redirect(route('slots.index'));

        } catch (Error $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
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

        $users = $this->userRepository->getUsers(['role_names' => Role::MENTOR])->pluck('name', 'id');
        $daysSelectOptions = $this->slotRepository->getDaysSelectOptions();
        $slotTypesSelectOptions = $this->slotRepository->getTypeSelectOptions();

        return view('slots.edit', compact('slot', 'users', 'daysSelectOptions', 'slotTypesSelectOptions'));
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
        try {
            $data = $request->validated();
            $slot = $this->slotRepository->find($id);

            if (empty($slot)) {
                Flash::error('Slot not found');
                return redirect(route('slots.index'));
            }

            $startTime = Carbon::parse($request->start_time);
            $endTime = Carbon::parse($request->end_time);

            if(!$startTime->isBefore($endTime))
                throw new Error('Shift start time should before end time');

            $shiftTimeLimit = Slot::SHIFT_TIME_LIMITS[$request->type];
            [$shiftStartAfter, $shiftEndBefore] = $shiftTimeLimit;
            if (!$startTime->between($shiftStartAfter, $shiftEndBefore) || !$endTime->between($shiftStartAfter, $shiftEndBefore))
                throw new Error('Shift start & end time must between '.$shiftStartAfter.' - '.$shiftEndBefore);

            $slotExists = $this->slotRepository->getBusySlotsDuringTimeDuration($startTime, $endTime)
                ->where([
                    'user_id' => $request->user_id,
                    'day' => $request->day,
                    'type' => $request->type
                ])
                ->whereNotIn('id', [$id])
                ->exists();

            if ($slotExists)
                throw new Error('Slot is already exists during your selected duration');

            $slot = $this->slotRepository->update($data, $id);
            Flash::success('Slot updated successfully.');

            return redirect(route('slots.index'));

        } catch (Error $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
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
