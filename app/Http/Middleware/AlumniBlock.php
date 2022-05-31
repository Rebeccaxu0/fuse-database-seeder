<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;

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
        if ($user->deFactoStudios()->count() == 0 && (!$user->isAdmin() || $user->isRoot())) {
            // Ensure active_studio is null.
            if (!is_null($user->activeStudio)) {
                $user->active_studio = null;
                $user->save();
            }
            // Ensure former Facilitators and Super Facilitators are demoted to student.
            if ($user->roles->count() > 0) {
                $user->roles()->detach();
                Cache::forget("u{$user->id}_has_role_*");
            }
            // You are either sent back to a sanctioned page or allowed to proceed to a sanctioned page (Registered lobby/ My Stuff).
            $from = $request->header('referer');
            $goingto = $request->path();
            if (str_contains($from, "login")) {
                return redirect(RouteServiceProvider::REGISTEREDLOBBY);
            }
            if (str_contains($from, "registeredlobby") && ($goingto == "mystuff")) {
            } else if (str_contains($from, "mystuff") && ($goingto == "registeredlobby")) {
            } else if ((str_contains($from, "mystuff") ||  str_contains($from, "registeredlobby")) && ($goingto == "challenges")) {
                return redirect()->to('https://www.fusestudio.net/challenges/')->with('status','Join a studio to access this page!');
            } else {
                // Flash message.  
                session()->flash('flash.banner', 'Join a studio to access this page!');
                session()->flash('flash.bannerStyle', 'danger');
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
