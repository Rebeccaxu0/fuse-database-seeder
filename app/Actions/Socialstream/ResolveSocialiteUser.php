<?php

namespace App\Actions\Socialstream;

use Illuminate\Support\Facades\Log;
use JoelButcher\Socialstream\Contracts\ResolvesSocialiteUsers;
use JoelButcher\Socialstream\Socialstream;
use Laravel\Socialite\Facades\Socialite;

class ResolveSocialiteUser implements ResolvesSocialiteUsers
{
    /**
     * Resolve the user for a given provider.
     *
     * @param  string  $provider
     * @return \Laravel\Socialite\AbstractUser
     */
    public function resolve($provider)
    {
        Log::debug("SSO Login Attempt", [$provider]);
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            Log::error('SSO Fail (stateful)', $e);
            try {
                $user = Socialite::driver($provider)->stateless()->user();
            } catch (Exception $e) {
                Log::error('SSO Fail (stateless)', $e);
                session()->flash('flash.banner', __('Unable to log you in. Please try again.'));
                return redirect('/login');
            }
        }
        Log::debug("SSO Login Success", [$provider, $user->email]);

        if (Socialstream::generatesMissingEmails()) {
            $user->email = $user->getEmail() ?? "{$user->id}@{$provider}" . config('app.domain');
        }

        return $user;
    }
}
