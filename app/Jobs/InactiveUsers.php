<?php

namespace App\Jobs;

use App\Models\Reminder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class InactiveUsers implements ShouldQueue 
{
    use Queueable;

    public $user;

    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lastactive = Carbon::parse($this->user->last_login_at);
        
        $reminder = new Reminder();
        $reminder->user_id = $this->user->id;
        $reminder->sent_at = now();
        $reminder->message = $this->user->name . ', your account has been inactive since ' . $lastactive->format('Y-m-d') . '. Please log in to keep it active.';
        $reminder->save();

        Log::info("Reminder sent to user: {$this->user->name} , your account has been inactive for a while. Please log in to keep it active.");
    }
}
