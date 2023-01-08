<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveAuthenticationLogs {

    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user)
        {
            $user = $event->user;
            $ip = $this->request->ip();
            $userAgent = $this->request->userAgent();

            DB::table('authentication_logs')->insert([
                'user_id'          => $user->id,
                'ip_address'       => $ip,
                'user_agent'       => $userAgent,
                'authenticated_at' => now(),
            ]);
        }
    }

}
