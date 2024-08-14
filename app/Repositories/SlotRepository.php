<?php

namespace App\Repositories;

use App\Models\Slot;
use App\Repositories\BaseRepository;

/**
 * Class SlotRepository
 * @package App\Repositories
 * @version March 21, 2024, 12:24 pm UTC
 */
class SlotRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'slot_time',
        'type'
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
        return Slot::class;
    }

    public function slots($params = [])
    {
        $query = Slot::query();

        return $query;
    }

    public function getBusySlotsDuringTimeDuration($startTime, $endTime)
    {
        $model = $this->model()::query();

        $model->where(function($query) use ($startTime, $endTime) {
            return $query->where(function($q) use ($startTime, $endTime) {
                return $q->whereBetween('start_time', [
                    $startTime, $endTime
                ])
                ->orWhereBetween('end_time', [
                    $startTime, $endTime
                ]);
            })->orWhere(function($q) use ($startTime, $endTime) {
                return $q->where('start_time', '<=', $startTime)
                        ->where('end_time', '>=', $endTime);
            });
        });

        return $model;
    }

    public function findByTimeAndType($user_id, $start_time, $end_time, $day, $type)
    {

        return Slot::where('user_id', $user_id)
            ->where('day', $day)
            ->where('type', $type)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($q) use ($start_time, $end_time) {
                    $q->where('start_time', '>=', $start_time)
                        ->where('start_time', '<', $end_time);
                })->orWhere(function ($q) use ($start_time, $end_time) {
                    $q->where('end_time', '>', $start_time)
                        ->where('end_time', '<=', $end_time);
                })->orWhere(function ($q) use ($start_time, $end_time) {
                    $q->where('start_time', '<=', $start_time)
                        ->where('end_time', '>=', $end_time);
                });
            })
            ->exists();
    }

    public function userSlots($user_id, $day)
    {
        return Slot::where('user_id', $user_id)->where('day', $day)->orderBy('type')
            ->orderBy('start_time')
            ->get()
            ->groupBy('type');
    }

    public function getDaysSelectOptions()
    {
        $days = \Carbon\Carbon::getDays();
        return array_combine($days, $days);
    }

    public function getTypeSelectOptions()
    {
        $model = $this->model();
        return $model::$typeTexts;
    }
}
