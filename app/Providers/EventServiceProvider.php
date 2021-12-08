<?php

namespace App\Providers;

use App\Listeners\SaveImpersonatorPassword;
use App\Listeners\RestoreImpersonatorPassword;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Lab404\Impersonate\Events\TakeImpersonation;
use Lab404\Impersonate\Events\LeaveImpersonation;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TakeImpersonation::class => [
            SaveImpersonatorPassword::class,
        ],
        LeaveImpersonation::class => [
            RestoreImpersonatorPassword::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
      //
    }
}
