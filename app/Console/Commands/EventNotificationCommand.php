<?php

namespace App\Console\Commands;

use App\Constants\NotificationServiceTemplateNames;
use App\Models\Event;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EventNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Events Status & Notify Users about it';

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
        Log::alert($this->signature . ' | '. now()->format('d-M H:i:s'));
        $dateTimeStartOfHour = clone $date = Carbon::now()->setSecond();
        $dateTimeStartOfHour->startOfHour();

        Event::whereDate('date', $date)
            ->where('start_time', $dateTimeStartOfHour)
            ->where('status', Event::UPCOMING_EVENT)
            ->update(['status' => Event::ONGOING_EVENT]);

        Event::whereDate('date', $date)
            ->where('end_time', $dateTimeStartOfHour)
            ->where('status', Event::ONGOING_EVENT)
            ->update(['status' => Event::COMPLETE_EVENT]);

        $startingEvents = Event::whereDate('date', $date)
            ->where('start_time', $dateTimeStartOfHour)
            ->where('status', Event::ONGOING_EVENT)->get();


        $appUsersIds = User::role(Role::API_USER)->pluck('id');
        $mentorUsersIds = User::role(Role::MENTOR)->pluck('id');
        $allUsers = array_merge($appUsersIds->toArray(), $mentorUsersIds->toArray());

        $usersWithDevices = getUsersWithDevicesForNotification($allUsers);

        foreach($startingEvents as $event)
        {
            $notificationType = NotificationServiceTemplateNames::EVENTS;

            $message = [__('event.notification.message', [], 'en'), __('event.notification.message', [], 'ar')];

            $title = [
                __('event.notification.title', [], 'en'),
                __('event.notification.title', [], 'ar')
            ];

            return sendNotificationToAllUsers($usersWithDevices, $notificationType, $event->id, $title, $message);
        }

        return 0;
    }
}
