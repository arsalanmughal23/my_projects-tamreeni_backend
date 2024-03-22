<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version February 5, 2024, 12:05 pm UTC
 */
class EventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'date',
        'start_time',
        'end_time',
        'duration',
        'description',
        'image',
        'user_id',
        'status',
        'body_part_id',
        'equipment_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Event::class;
    }

    public function events($parameters = [])
    {
        $query = Event::query();

        // If a specific date is provided, filter events by that date
        if (isset($parameters['all_day_event'])) {
            $query->whereDate('date', $parameters['all_day_event']);
        }
        if (isset($parameters['date'])) {
            $startOfWeek = Carbon::parse($parameters['date'])->startOfWeek()->format('Y-m-d');
            $endOfWeek   = Carbon::parse($parameters['date'])->endOfWeek()->format('Y-m-d');
            $query->whereBetween('date', [$startOfWeek, $endOfWeek])->orderBy('created_at', 'asc');
        }

        return $query;
    }

    public function allEvents($currentDate = null)
    {
        // If $currentDate is not provided, use the current date
        $currentDate = $currentDate ?? now()->format('Y-m-d');

        // Get the start and end dates of the current week
        $startOfWeek = Carbon::parse($currentDate)->startOfWeek();
        $endOfWeek   = Carbon::parse($currentDate)->endOfWeek();

        // Retrieve events within the current week
        $events = Event::whereBetween('date', [$startOfWeek, $endOfWeek])->get();

        return $events;
    }

    public function allDayEvents($currentDate = null)
    {
        // Get the start and end dates of the current week
//        $specificDate = Carbon::parse($currentDate);
        // Retrieve events within the current week
        $events = Event::where('date', $currentDate)->get();

        return $events;
    }

    public function eventDeatils($id)
    {
        return Event::where('id', $id)
            ->with('bodyPart', 'equipment', 'user')
            ->with('user_events.user')
            ->first();
    }

}
