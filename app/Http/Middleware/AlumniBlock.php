<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // If a user is unaffiliated (not a member of any studio/school/district)
        // and NOT an admin.
        if ($user->deFactoStudios()->count() == 0 && ! $user->isAdmin() && ! $user->isRoot()) {
            // If the user has any starts, they are an alumni user and should
            // have access to their My Stuff page.
            // Otherwise, they are a new user via SSO and should be locked in
            // the lobby.

            $goingTo = $request->path();

            // You can always go to the public Challenge Gallery.
            if ($goingTo == 'challenges') {
                return redirect()->to('https://www.fusestudio.net/challenges/');
            }
            // New SSO registrations need to stay in the lobby.
            if ($user->starts->count() == 0) {
                if ($goingTo != 'registeredlobby') {
                    return redirect(RouteServiceProvider::REGISTEREDLOBBY);
                }
            }
            // Alumni users are allowed to see their My Stuff page, too.
            else if ($goingTo != 'registeredlobby' && $goingTo != 'mystuff') {
                session()->flash('flash.banner', 'Join a studio to access that page!');
                session()->flash('flash.bannerStyle', 'danger');
                return redirect(RouteServiceProvider::REGISTEREDLOBBY);
            }
        }
        return $next($request);
    }
}
