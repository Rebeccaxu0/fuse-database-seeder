<?php

namespace App\Listeners;

use Lab404\Impersonate\Events\LeaveImpersonation;

class RestoreImpersonatorPassword
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
     * @param  LeaveImpersonation  $event
     * @return void
     */
    public function handle(LeaveImpersonation $event)
    {
      session()->put([
        'password_hash_web' =>  $event->impersonator->getAuthPassword(),
      ]);
    }
}
