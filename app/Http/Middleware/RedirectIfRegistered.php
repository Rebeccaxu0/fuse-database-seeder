<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfRegistered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // If a user is NOT a member of any org and NOT an admin
        if ($user->deFactoStudios()->count() == 0 && (! $user->isAdmin() || $user->isRoot())) {
            // Ensure active_studio is null.
            if (! is_null($user->activeStudio)) {
                $user->active_studio = null;
                $user->save();
            }
            // Ensure former Facilitators and Super Facilitators are demoted to student.
            if ($user->roles->count() > 0) {
                $user->roles()->detach();
                Cache::forget("u{$user->id}_has_role_*");
            }
            return redirect(RouteServiceProvider::REGISTEREDLOBBY);
        }

        return $next($request);
    }
}
