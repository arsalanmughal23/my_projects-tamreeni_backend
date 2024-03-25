<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class AppointmentRepository
 * @package App\Repositories
 * @version March 21, 2024, 5:51 pm UTC
*/

class AppointmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'user_id',
        'slot_id',
        'package_id',
        'transaction_id',
        'date',
        'type',
        'profession_type'
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
        return Appointment::class;
    }

    public function getAppointment($params = []){
        $query = Appointment::query();

        // If a specific date is provided, filter events by that date
        if (isset($parameters['all_day_appointment'])) {
            $query->whereDate('date', $params['all_day_appointment']);
        }
        if (isset($parameters['date'])) {
            $startOfWeek = Carbon::parse($params['date'])->startOfWeek()->format('Y-m-d');
            $endOfWeek   = Carbon::parse($params['date'])->endOfWeek()->format('Y-m-d');
            $query->whereBetween('date', [$startOfWeek, $endOfWeek])->orderBy('created_at', 'asc');
        }

        if (isset($parameters['type'])) {
            $query->where('type', $params['type']);
        }

        if (isset($parameters['profession_type'])) {
            $query->where('profession_type', $params['profession_type']);
        }

        if (isset($parameters['status'])) {
            $query->where('status', $params['status']);
        }

        if(isset($params['order']) && isset($params['order_by'])){
            $query->orderBy($params['order'], $params['order_by']);
        }

        return $query;
    }

    public function checkSlotAvailable($user_id,$slot_id){

        return Appointment::where('user_id', $user_id)
            ->where('slot_id', $slot_id)
            ->whereIn('status', [Appointment::STATUS_PENDING,Appointment::STATUS_START])
            ->exists();
    }

    public function checkSlotAvailableDate($user_id,$date){

        return Appointment::where('user_id', $user_id)->whereDate('date', $date)
            ->whereIn('status', [Appointment::STATUS_PENDING,Appointment::STATUS_START])
            ->exists();
    }

    public function checkUserAppointment($customer_id, $user_id, $date){
        return Appointment::where('user_id', $user_id)->where('customer_id', $customer_id)->whereDate('date', $date)
            ->whereIn('status', [Appointment::STATUS_PENDING,Appointment::STATUS_START])
            ->exists();
    }
}
