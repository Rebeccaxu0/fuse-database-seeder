<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event)
    {
        Log::channel('fuse_activity_log')
            ->info('user_login', ['user' => $event->user]);
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event)
    {
        Log::channel('fuse_activity_log')
            ->info('user_logout', ['user' => $event->user]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    }
}