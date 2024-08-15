<?php

namespace App\Http\Controllers;

use App\DataTables\EventDataTable;
use App\Helper\FileHelper;
use App\Http\Requests;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Role;
use App\Repositories\BodyPartRepository;
use App\Repositories\ExerciseEquipmentRepository;
use App\Repositories\UsersRepository;
use Response;

class EventController extends AppBaseController
{
    /** @var EventRepository $eventRepository*/

    public function __construct(
        private EventRepository $eventRepository,
        private UsersRepository $userRepository,
        private BodyPartRepository $bodyPartRepository,
        private ExerciseEquipmentRepository $exerciseEquipmentRepository
    ) {}

    /**
     * Display a listing of the Event.
     *
     * @param EventDataTable $eventDataTable
     *
     * @return Response
     */
    public function index(EventDataTable $eventDataTable)
    {
        return $eventDataTable->render('events.index');
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->getSelectOptionData();
        $users = $data['users'] ?? [];
        $bodyParts = $data['bodyParts'] ?? [];
        $exerciseEquipments = $data['exerciseEquipments'] ?? [];

        return view('events.create', compact('users', 'bodyParts', 'exerciseEquipments'));
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param CreateEventRequest $request
     *
     * @return Response
     */
    public function store(CreateEventRequest $request)
    {
        $input = $request->validated();

        if ($request->hasFile('image'))
            $input['image'] = FileHelper::s3Upload($input['image']);

        $event = $this->eventRepository->create($input);

        Flash::success('Event saved successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Display the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->getSelectOptionData();
        $users = $data['users'] ?? [];
        $bodyParts = $data['bodyParts'] ?? [];
        $exerciseEquipments = $data['exerciseEquipments'] ?? [];

        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.edit', compact('event', 'users', 'bodyParts', 'exerciseEquipments'));
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int $id
     * @param UpdateEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        $event = $this->eventRepository->find($id);
        $input = $request->validated();

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        if ($request->hasFile('image'))
            $input['image'] = FileHelper::s3Upload($input['image']);

        $event = $this->eventRepository->update($input, $id);

        Flash::success('Event updated successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        $this->eventRepository->delete($id);

        Flash::success('Event deleted successfully.');

        return redirect(route('events.index'));
    }

    public function getSelectOptionData()
    {
        return [
            'users' => $this->userRepository->getUsers(['role_names' => Role::MENTOR])->pluck('name', 'id'),
            'bodyParts' => $this->bodyPartRepository->pluck('name', 'id'),
            'exerciseEquipments' => $this->exerciseEquipmentRepository->pluck('name', 'id'),
        ];
    }
}
