<?php

namespace App\Console\Commands;

use App\Jobs\InactiveUsers;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Reminder;
use Carbon\Carbon;

class CheckInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check inactive users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = env('INACTIVE_DAYS', 7);

        $users = User::where('last_login_at', '<', Carbon::now()->subDays($days))->get();

        foreach ($users as $user) {

            $alreadySentToday = Reminder::where('user_id', $user->id)
                ->whereDate('sent_at', today())
                ->exists();

            if (!$alreadySentToday) {
                InactiveUsers::dispatch($user);
            }
        }
    }
}
