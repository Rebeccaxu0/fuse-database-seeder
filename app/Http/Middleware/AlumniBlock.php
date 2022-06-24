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
        // If a user is NOT a member of any org and NOT an admin
        if ($user->deFactoStudios()->count() == 0 && ! $user->isAdmin() && ! $user->isRoot()) {
            // You are either sent back to a sanctioned page or allowed to proceed to a sanctioned page (Registered lobby/ My Stuff).
            $from = $request->header('referer');
            $goingto = $request->path();
            $whitelist = ['mystuff', 'registeredlobby', 'registrationlobby'];

            if (str_contains($from, "login")) {
                return redirect(RouteServiceProvider::REGISTEREDLOBBY);
            }
            if ((str_contains($from, 'mystuff') ||  str_contains($from, 'registrationlobby') ||  str_contains($from, 'registeredlobby')) && ($goingto == 'challenges')) {
                return redirect()->to('https://www.fusestudio.net/challenges/')->with('status', 'Join a studio to access this page!');
            }
            // If not in whitelist:
            else if (! in_array($goingto, $whitelist)) {
                // Flash message.
                session()->flash('flash.banner', 'Join a studio to access that page!');
                session()->flash('flash.bannerStyle', 'danger');
                return redirect(RouteServiceProvider::REGISTEREDLOBBY);
            }
        }
        return $next($request);
    }
}
