<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CleverAppLaunch
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
        // We can't know from the request URL if this is an app launch from
        // Clever, or an attempt to connect to the Clever provider from the
        // user's profile page. But if this *is* a Clever app launch event,
        // we want to avoid multiple Clever accounts linked to one Laravel account.
        $user = Auth::user();
        if ($user && str_contains($request->path(), 'clever')
            && $user->connectedAccounts->where('provider', 'clever')->count()
         ) {
            Auth::logout();
        }
        return $next($request);
    }
}
