<?php

namespace App\Providers;

use App\Auth\SocialiteProviders\Clever\CleverExtendSocialite;
use App\Listeners\RestoreImpersonatorPassword;
use App\Listeners\SaveImpersonatorPassword;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TakeImpersonation::class => [
            SaveImpersonatorPassword::class,
        ],
        LeaveImpersonation::class => [
            RestoreImpersonatorPassword::class,
        ],
        SocialiteWasCalled::class => [
            CleverExtendSocialite::class,
        ],
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
