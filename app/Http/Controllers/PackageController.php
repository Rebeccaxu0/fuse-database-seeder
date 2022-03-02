<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Package::class, 'package');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package
            ::with(['challenges', 'districts', 'schools', 'studios'])
            ->orderBy('name')
            ->get();
        return view('admin.package.index', ['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create', ['challenges' => Challenge::all()]);
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
            'name' => 'required|unique:packages|max:255',
        ]);

        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'student_activity_tab_access' => $request->boolean('student_activity_tab_access'),
        ]);
        $package->save();
        $package->challenges()->attach($request->challenges);

        return redirect(route('admin.packages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('admin.package.edit', [
            'challenges' => Challenge::all(),
            'package' => $package,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'student_activity_tab_access' => $request->boolean('student_activity_tab_access'),
        ]);
        $package->challenges()->sync($request->challenges);

        return redirect(route('admin.packages.index'));
    }

    /**
     * Copy the package and allow user to edit from there. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function copy(Package $package)
    {
        $newpackage = Package::create([
            'name' => $package->name . ' Copy',
            'description' => $package->description,
            'student_activity_tab_access' => $package->student_activity_tab_access,
        ]);
        $newpackage->save();
        $newpackage->challenges()->attach($package->challenges);
        return redirect(route('admin.packages.edit', $newpackage));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect(route('admin.packages.index'));
    }
}
