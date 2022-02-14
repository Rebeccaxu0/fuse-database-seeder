<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.studio.index', [
            'districts' => District::all()->sortBy('name'),
            'schools' => School::all()->sortBy('name'),
        ]);
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
        $request->flash();
        $validated = $request->validate([
            'name' => 'required|studios|max:255',
        ]);

        return redirect(route('admin.studios.index'));
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
        return view('admin.studio.edit', [
                        'packages' => Package::all()->sortBy('name'),
                        'studio' => $studio
                    ]);
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
        $studio->update([
            'name' => $request->name,
            'package_id' => $request->package
        ]);

        return redirect(route('admin.studios.index'));
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

    /**
     */
    public function active_studio(Studio $studio)
    {
        Auth::user()->active_studio = $studio->id;
        Auth::user()->save();

        return redirect(request()->header('Referer'));
    }
}
