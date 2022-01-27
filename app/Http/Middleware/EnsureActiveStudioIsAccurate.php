<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureActiveStudioIsAccurate
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
        // If a user is a member of any org...
        if (Auth::user()->deFactoStudios()->count() > 0) {
            // ...and has no active studio...
            if (is_null(Auth::user()->activeStudio)
                // ...or if Auth::user() is no longer a member of active studio.
                || ! Auth::user()->deFactoStudios()->contains(Auth::user()->activeStudio)) {
                // THEN set activestudio to first available.
                Auth::user()->activeStudio()->associate(Auth::user()->deFactoStudios()->first());
                Auth::user()->save();
            }
        }
        else {
            // Ensure activeStudio is null if Auth::user() is not a member of any org.
            if (! is_null(Auth::user()->activeStudio)) {
                Auth::user()->activeStudio()->dissociate();
                Auth::user()->save();
            }
        }

        return $next($request);
    }
}
