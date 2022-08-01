<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

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
      Cache::flush();
      session()->flash('flash.banner', 'Cache cleared!');

      return redirect(route('admin'));
    }
}
