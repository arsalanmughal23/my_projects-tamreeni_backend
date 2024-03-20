<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEventAPIRequest;
use App\Http\Requests\API\UpdateEventAPIRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\Favourite;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Config;
use DB;

/**
 * Class EventController
 * @package App\Http\Controllers\API
 */
class EventAPIController extends AppBaseController
{
    /** @var  EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
    }

    /**
     * Display a listing of the Event.
     * GET|HEAD /events
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $perPage     = $request->input('per_page', Config::get('constants.PER_PAGE', 10));
        $eventsQuery = $this->eventRepository->events();

        $eventsList = null;


        if ($request->get('date')) {
            $eventsList = $this->eventRepository->allEvents($request->get('date'));
        }

        // Paginate the results
        if ($request->get('paginate')) {
            $eventsList = $eventsQuery->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $eventsList = $eventsQuery->orderBy('created_at', 'desc')->get();
        }

        return $this->sendResponse(EventResource::collection($eventsList), 'Events retrieved successfully');
    }

    /**
     * Store a newly created Event in storage.
     * POST /events
     *
     * @param CreateEventAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateEventAPIRequest $request)
    {
        $input = $request->all();

        $startTimestamp = $request->input('start_time');
        $endTimestamp   = $request->input('end_time');

        if ($startTimestamp >= $endTimestamp) {
            return $this->sendError('Start time must be less than end time.');
        }

        $input['user_id'] = $request->user()->id;
        $event            = $this->eventRepository->create($input);

        return $this->sendResponse(new EventResource($event), 'Event saved successfully');
    }

    /**
     * Display the specified Event.
     * GET|HEAD /events/{id}
     *
     * @param int $id
     *
     * @return Response
     */

    public function show($id)
    {
        /** @var Event $event */
        $event = $this->eventRepository->eventDeatils($id);

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        return $this->sendResponse(new EventResource($event), 'Event retrieved successfully');
    }

    /**
     * Update the specified Event in storage.
     * PUT/PATCH /events/{id}
     *
     * @param int $id
     * @param UpdateEventAPIRequest $request
     *
     * @return Response
     */

    public function update($id, UpdateEventAPIRequest $request)
    {
        $input = $request->all();

        /** @var Event $event */
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        $event = $this->eventRepository->update($input, $id);

        return $this->sendResponse($event->toArray(), 'Event updated successfully');
    }

    /**
     * Remove the specified Event from storage.
     * DELETE /events/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function destroy($id)
    {
        /** @var Event $event */
        $event = $this->eventRepository->find($id);

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        $event->delete();

        return $this->sendSuccess('Event deleted successfully');
    }

    public function markInterested(Request $request)
    {
        if (!$request->input('event_id')) {
            return $this->sendError('Event Id is required', 422);
        }
        if (!$request->input('user_id')) {
            return $this->sendError('User Id is required', 422);
        }
        $instanceId = $request->input('event_id');
        $user_id    = $request->input('user_id');

        // Check if the meal is already marked as a favorite
        $existingFavorite = Favourite::where('user_id', $user_id)
            ->where('favouritable_id', $instanceId)
            ->where('favouritable_type', 'event')
            ->first();

        if ($existingFavorite) {
            // Meal is already marked as favorite, unmark it
            $existingFavorite->delete();

            return $this->sendResponse(new \stdClass(), 'UnMarked');
        }

        // Meal is not marked as favorite, mark it
        Favourite::create([
            'user_id'           => $user_id,
            'favouritable_id'   => $instanceId,
            'favouritable_type' => 'event',
        ]);

        return $this->sendResponse(new \stdClass(), 'Marked as Interested');
    }
}
