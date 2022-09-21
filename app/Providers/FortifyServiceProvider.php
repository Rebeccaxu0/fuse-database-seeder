<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use Selfsimilar\D7Password\Facades\D7Password as D7Hash;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // This is just here to facilitate debugging why login intermittently
        // doesn't redirect properly and leaves a body stranded on the login
        // page with a stale form that throws a 419 on resubmit.
        // $this->app->instance(LoginResponse::class, new class implements LoginResponse {
        //     public function toResponse($request)
        //     {
        //         Log::debug('Login Redirect for user ' . Auth::user()->name);
        //         return redirect('/dashboard');
        //     }
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->name . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('name', $request->name)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    return $user;
                } else if (D7Hash::check($request->password, $user->password)) {
                    $user->update(['password' => Hash::make($request->password)]);
                    return $user;
                }
                else {
                    foreach ($user->studios as $studio) {
                        if ($studio->universal_pwd
                            && str($request->password)->trim()->lower() == str($studio->join_code)->trim()->lower()) {
                            $user->update(['active_studio' => $studio->id]);
                            return $user;
                        }
                    }
                }
            }
        });
    }
}
