<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        $user = Auth::user();
        // If a user is a member of any org...
        if ($user->deFactoStudios()->count() > 0) {
            // ...and has no active studio...
            if (is_null($user->activeStudio)
                // ...or if Auth::user() is no longer a member of active studio.
                || ! $user->deFactoStudios()->contains($user->activeStudio)) {
                // THEN set activestudio to first available.
                $user->activeStudio()->associate($user->deFactoStudios()->first());
                $user->save();
            }
        }
        else {
            // Ensure activeStudio is null if Auth::user() is not a member of any org.
            if (! is_null($user->activeStudio)) {
                $user->activeStudio()->dissociate();
                $user->save();
            }
            // Remove all roles. An unaffiliated use cannot be a facilitator or admin.
            $user->roles()->detach();
            Cache::forget("u{$user->id}_has_role_*");
        }

        return $next($request);
    }
}
