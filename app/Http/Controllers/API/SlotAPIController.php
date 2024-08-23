<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSlotAPIRequest;
use App\Http\Requests\API\UpdateSlotAPIRequest;
use App\Models\Slot;
use App\Repositories\AppointmentRepository;
use App\Repositories\SlotRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Validator;
use Config;

/**
 * Class SlotController
 * @package App\Http\Controllers\API
 */
class SlotAPIController extends AppBaseController
{
    /** @var  SlotRepository */
    private $slotRepository;
    private $appointmentRepository;

    public function __construct(SlotRepository $slotRepo, AppointmentRepository $appointmentRepo)
    {
        $this->slotRepository        = $slotRepo;
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * Display a listing of the Slot.
     * GET|HEAD /slots
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $slots   = $this->slotRepository->slots();

        if ($request->get('paginate')) {
            $slots = $slots->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $slots = $slots->get();
        }

        return $this->sendResponse($slots->toArray(), 'Slots retrieved successfully');
    }

    /**
     * Store a newly created Slot in storage.
     * POST /slots
     *
     * @param CreateSlotAPIRequest $request
     *
     * @return Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'       => 'required|integer|in:10,20,30',
            'start_time' => 'required|date_format:h:i A',
            'end_time'   => 'required|date_format:h:i A',
            'day'        => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        $validator->after(function ($validator) use ($request) {
            $startTime = Carbon::createFromFormat('H:i A', $request->start_time);
            $endTime   = Carbon::createFromFormat('h:i A', $request->end_time);


            // Check if start time is less than end time
            if ($startTime->gt($endTime)) {
                $validator->errors()->add('start_time', 'Start time must be before end time.');
            }

            // Check if start time and end time are not the same
            if ($startTime->eq($endTime)) {
                $validator->errors()->add('end_time', 'Start time and end time cannot be the same.');
            }

            // Check slot time validity based on type
            if ($request->type == 10 && !($startTime->between(Carbon::parse('08:00 AM'), Carbon::parse('12:00 PM')))) {
                $validator->errors()->add('start_time', 'Morning slots must be between 08:00 AM to 12:00 PM.');
            } elseif ($request->type == 20 && !($startTime->between(Carbon::parse('12:00 PM'), Carbon::parse('05:00 PM')))) {
                $validator->errors()->add('start_time', 'Afternoon slots must be between 12:00 PM to 05:00 PM.');
            } elseif ($request->type == 30 && !($startTime->between(Carbon::parse('05:00 PM'), Carbon::parse('10:00 PM')))) {
                $validator->errors()->add('start_time', 'Evening slots must be between 05:00 PM to 10:00 PM.');
            }

            // Check end time validity based on type
            if ($request->type == 10 && !($endTime->between(Carbon::parse('08:00 AM'), Carbon::parse('12:00 PM')))) {
                $validator->errors()->add('end_time', 'Morning slots must be between 08:00 AM to 12:00 PM.');
            } elseif ($request->type == 20 && !($endTime->between(Carbon::parse('12:00 PM'), Carbon::parse('05:00 PM')))) {
                $validator->errors()->add('end_time', 'Afternoon slots must be between 12:00 PM to 05:00 PM.');
            } elseif ($request->type == 30 && !($endTime->between(Carbon::parse('05:00 PM'), Carbon::parse('10:00 PM')))) {
                $validator->errors()->add('end_time', 'Evening slots must be between 05:00 PM to 10:00 PM.');
            }


            $existingSlot = $this->slotRepository->findByTimeAndType(
                $request->user()->id,
                $request->start_time,
                $request->end_time,
                $request->day,
                $request->type
            );

            if ($existingSlot) {
                $validator->errors()->add('start_time', 'This slot already exists for the ' . $request->day . ' ' . Slot::$typeTexts[$request->type] . '.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }


        $input            = $request->all();
        $input['user_id'] = $request->user()->id;
        $slot             = $this->slotRepository->create($input);

        return $this->sendResponse($slot->toArray(), 'Slot saved successfully');
    }

    /**
     * Display the specified Slot.
     * GET|HEAD /slots/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Slot $slot */
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            return $this->sendError('Slot not found');
        }

        return $this->sendResponse($slot->toArray(), 'Slot retrieved successfully');
    }

    /**
     * Update the specified Slot in storage.
     * PUT/PATCH /slots/{id}
     *
     * @param int $id
     * @param UpdateSlotAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateSlotAPIRequest $request)
    {
        $input = $request->all();

        /** @var Slot $slot */
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            return $this->sendError('Slot not found');
        }

        $slot = $this->slotRepository->update($input, $id);

        return $this->sendResponse($slot->toArray(), 'Slot updated successfully');
    }

    public function userSlots(Request $request)
    {
        $user = $request->user();
        $date  = Carbon::parse($request->input('date'));
        $day   = $date->format('l');
        $slots = $this->slotRepository->userSlots($request->input('user_id'), $day);

        $groupedSlots = [];

        // Loop through each group of slots
        foreach ($slots as $type => $typeSlots) {
            // Initialize an array to store sorted slot times within each type
            $sortedSlotTimes = [];

            // Sort slot times within each type
            foreach ($typeSlots as $key => $slot) {
                $checkAppointment = $this->appointmentRepository
                    ->getBookedAppointments($slot, $date, $user->id)->exists();
                    // ->checkSlotAvailable($request->input('user_id'), $user->id, $slot->id, $date);
                $isAvailable      = $checkAppointment ? false : true;

                $sortedSlotTimes[$key]['id']           = $slot->id;
                $sortedSlotTimes[$key]['start_time']   = $slot->start_time;
                $sortedSlotTimes[$key]['end_time']     = $slot->end_time;
                $sortedSlotTimes[$key]['day']          = $slot->day;
                $sortedSlotTimes[$key]['is_available'] = $isAvailable;
            }

            // Store sorted slot times under each type
            $groupedSlots[Slot::$typeTexts[$type]] = $sortedSlotTimes;
        }

        return $this->sendResponse($groupedSlots, 'Slots retrieved successfully');
    }

    /**
     * Remove the specified Slot from storage.
     * DELETE /slots/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Slot $slot */
        $slot = $this->slotRepository->find($id);

        if (empty($slot)) {
            return $this->sendError('Slot not found');
        }

        $slot->delete();

        return $this->sendSuccess('Slot deleted successfully');
    }
}
