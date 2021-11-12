<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Challenge;
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
        $packages = Package::all();
        return view('packagelist', ['data' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $challenges = Challenge::all();
        return view('addpackage',['challenges' => $challenges]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPackage = Package::create([
            'name' => $request->title,
            'description' => $request->description,
            'package_id' => 1,
            'student_activity_tab_access' => 0
        ])->save();

        return redirect('admin/packages');
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
        $challenges = Challenge::all();
        return view('editpackage',[
            'challenges' => $challenges,
            ‘package’ => $package]);
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
            'name' => $request->title,
            'description' => $request->description,
            'package_id' => 1,
            'student_activity_tab_access' => 0
        ]);

        return redirect('admin/packages');
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
        return redirect('admin/packages');

    }
}
