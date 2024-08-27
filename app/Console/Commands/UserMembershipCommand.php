<?php

namespace App\Console\Commands;

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

        return 0;
    }
}
