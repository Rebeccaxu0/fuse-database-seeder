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
                Cache::tags(["u{$user->id}_roles"])->flush();
            }
        }
        else {
            // Ensure all studio/school/district members have a valid `active_studio` set.
            if (is_null($user->activeStudio)
                // If user is no longer a member of their active_studio.
                || ! $user->deFactoStudios()->contains($user->active_studio)) {
                $user->active_studio = $user->deFactoStudios()->first()->id;
                $user->save();
                // User in request is stale and can cause errors.
                // TODO: Ideally we update the user in the session/request and
                // continue on our way but not sure how to do that.
                // This resubmit could jack up POSTs.
                return redirect($request->path());
            }
        }

        return $next($request);
    }
}
