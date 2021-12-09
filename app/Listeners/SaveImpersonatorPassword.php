<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Lab404\Impersonate\Events\TakeImpersonation;

class SaveImpersonatorPassword
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
     * @param  TakeImpersonation  $event
     * @return void
     */
    public function handle(TakeImpersonation $event)
    {
      session()->put([
        'password_hash_web' =>  $event->impersonated->getAuthPassword(),
      ]);
    }
}