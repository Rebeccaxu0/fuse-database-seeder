<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->authorizeResource(Studio::class, 'studio');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studios = Studio
            ::with(['school', 'students', 'facilitators'])
            ->orderBy('name')
            ->paginate(20);
        return view('admin.studio.index', ['studios' => $studios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studio $studio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studio $studio)
    {
        //
    }
}
