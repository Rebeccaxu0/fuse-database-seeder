<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportStudioActivityRequest;
use App\Models\District;
use App\Models\Package;
use App\Models\School;
use App\Models\Studio;
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
            'studio' => $studio,
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
            'package_id' => $request->package,
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
        $studio->delete();
        return redirect(route('admin.studios.index'));
    }

    /**
     * Switch the active studio for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request, Studio $studio)
    {
        $this->authorize('switch', $studio);

        Auth::user()->active_studio = $studio->id;
        Auth::user()->save();

        return redirect(request()->header('Referer'));
    }

    public function exportActivity(ExportStudioActivityRequest $request, Studio $studio)
    {
        $validated = $request->validated();
        $user = Auth::user();

        $name = $studio->school
            ? "{$studio->school->name}-$studio->name"
            : $studio->name;
        $filename = preg_replace('/[^a-z0-9]+/', '-', strtolower($name)) . '.csv';
        return response()->streamDownload(function () {
          $handle = fopen('php://output', 'w');
          fputcsv($handle, ['id', 'name', 'fullname']);
          // This is demonstration code to show how to properly stream large CSV
          // files.
          User::where('id', '<', 1000)->chunk(500, function($users) use($handle) {
              foreach($users as $user) {
                fputcsv($handle, [$user->id, $user->name, $user->full_name]);
              }
          });
          fclose($handle);
        },
            $filename);
    }
}
