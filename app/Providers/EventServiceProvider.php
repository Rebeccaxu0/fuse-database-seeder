<?php

namespace App\Providers;

use App\Auth\SocialiteProviders\Clever\CleverExtendSocialite;
use App\Listeners\RestoreImpersonatorPassword;
use App\Listeners\SaveImpersonatorPassword;
use App\Listeners\StudioUpdateSubscriber;
use App\Listeners\UserEventSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lab404\Impersonate\Events\LeaveImpersonation;
use Lab404\Impersonate\Events\TakeImpersonation;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LeaveImpersonation::class => [
            RestoreImpersonatorPassword::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class => [
            CleverExtendSocialite::class,
        ],
        TakeImpersonation::class => [
            SaveImpersonatorPassword::class,
        ],
    ];

    /**
     * The event subscriber mappings for the application.
     *
     * @var array
     */
    protected $subscribe = [
        UserEventSubscriber::class,
        StudioUpdateSubscriber::class,
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
