<?php

namespace App\Console\Commands;

use App\Constants\NotificationServiceTemplateNames;
use App\Models\UserMembership;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UserMembershipCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usermembership:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify User-Membership & mark as expire to expired User-Membership';

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
        $date = Carbon::now();

        UserMembership::where('expire_at', '<=', $date)
            ->update(['status' => UserMembership::STATUS_EXPIRE]);

        // GET: UserMembership those exipry date is equal to next 3rd day
        $userMemberships = UserMembership::where('status', UserMembership::STATUS_ACTIVE)
            ->whereDate('expire_at', Carbon::now()->addDay(3))->get();

        foreach($userMemberships as $userMembership)
        {
            $user = $userMembership?->user;
            if(!$user)
                continue;

            $notificationType = NotificationServiceTemplateNames::BILLING_REMINDER;

            $message = [
                __('payment.notification.billing_reminder.message', [], 'en'),
                __('payment.notification.billing_reminder.message', [], 'ar')
            ];
            $title = [
                __('payment.notification.billing_reminder.title', [], 'en'),
                __('payment.notification.billing_reminder.title', [], 'ar')
            ];

            sendNotification($user, $notificationType, $user->id, $title, $message);
        }
        return 0;
    }
}
