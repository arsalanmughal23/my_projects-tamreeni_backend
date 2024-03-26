<?php

namespace App\Http\Requests\API;

use App\Models\Appointment;
use InfyOm\Generator\Request\APIRequest;

class CreateAppointmentAPIRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Appointment::$rules;
    }

    public function messages()
    {
        return [
            'appointments.*.slot_id.required'    => 'The slot field is required.',
            'appointments.*.date.required'       => 'The date field is required.',
            'appointments.*.start_time.required' => 'The start time field is required.',
            'appointments.*.end_time.required'   => 'The end time field is required.',
        ];
    }
}
