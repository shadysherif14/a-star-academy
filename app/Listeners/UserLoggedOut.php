<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout as LogoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserLoggedOut
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(LogoutEvent $event)
    {
        $user = $event->user;
        $user->invalidateAllLogginSessions();
    }
}