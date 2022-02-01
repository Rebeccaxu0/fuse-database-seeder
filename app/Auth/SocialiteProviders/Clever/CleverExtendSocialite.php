<?php

namespace App\Auth\SocialiteProviders\Clever;

use SocialiteProviders\Manager\SocialiteWasCalled;

class CleverExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param  \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('clever', Provider::class);
    }
}
