<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class CacheController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearAll()
    {
        Gate::allowIf(Auth::user()->isAdmin());

        Cache::flush();
        session()->flash('flash.banner', 'Cache cleared!');

        return redirect(route('admin.index'));
    }
}
