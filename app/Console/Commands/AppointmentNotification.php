<?php

namespace App\Console\Commands;

use App\Constants\NotificationServiceTemplateNames;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AppointmentNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Appointment & Notify User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::alert('appointment:notification | '. now()->format('d-M H:i:s'));
        $date = Carbon::now();
        $dateTimeStartOfHour = $date->startOfHour();

        // Pick a reminder Date Time for pick the appointments and notify users for their appointment
        $dateTimeOfNextHour = $dateTimeStartOfHour->addHour(1);

        // Current Start Time Appointment status marked as START
        Appointment::where('payment_status', Appointment::PAYMENT_STATUS_PAID)
            ->where('date', $dateTimeStartOfHour)
            ->where('start_time', $dateTimeStartOfHour->format('H:i:s'))
            ->where('status', Appointment::STATUS_PENDING)
            ->update(['status' => Appointment::STATUS_START]);

        // Current End Time Appointment status marked as END
        Appointment::where('payment_status', Appointment::PAYMENT_STATUS_PAID)
            ->where('date', $dateTimeStartOfHour)
            ->where('end_time', $dateTimeStartOfHour->format('H:i:s'))
            ->where('status', Appointment::STATUS_START)
            ->update(['status' => Appointment::STATUS_END]);


        // Get All Next Hour Appointments
        $nextHourAppointment = Appointment::where('payment_status', Appointment::PAYMENT_STATUS_PAID)
            ->where('date', $dateTimeOfNextHour)
            ->where('start_time', $dateTimeOfNextHour->format('H:i:s'))
            ->where('status', Appointment::STATUS_PENDING);


        // Send Reminder Notification to App Users for Next Hour Appointments
        foreach($nextHourAppointment as $eachAppointment) {
            $user = $eachAppointment->user;
            $customer = $eachAppointment->customer;
            $notificationType = NotificationServiceTemplateNames::APPOINTMENT;

            $message = [__('appointment.notification.message', [], 'en'), __('appointment.notification.message', [], 'ar')];

            $title = [
                __('appointment.notification.title', ['name' => $user->name, 'time' => $dateTimeOfNextHour->format('d-M H:i')], 'en'),
                __('appointment.notification.title', ['name' => $user->name, 'time' => $dateTimeOfNextHour->format('d-M H:i')], 'ar')
            ];

            sendNotification($customer, $notificationType, $eachAppointment->id, $title, $message);
        }

        return 0;
    }
}
