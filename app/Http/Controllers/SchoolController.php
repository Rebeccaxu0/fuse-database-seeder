<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\School;
use App\Models\Studio;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(School::class, 'school');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::with(['district', 'studios'])
            ->orderBy('name')
            ->paginate(20);
        return view('admin.school.index', ['schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.school.create', [
            'packages' => Package::all()->sortBy('name'),
        ]);
    }

    /**
     *
     *
     *
     */
    public function createstudios(School $school)
    {
        return view('admin.school.createstudios', [
            'studios' => Studio::all()->sortBy('name'),
            'school' => $school,
        ]);
    }

    /**
     * 
     *
     * 
     */
    public function addstudios(Request $request, School $school)
    {
        if (! empty($request->createstudios)) {
            $school->createStudios($request->createstudios);
        }
        return redirect(route('admin.studios.index', ['id' => $school->id]));
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
            'name' => 'required|unique:schools|max:255',
        ]);


        $school = School::create([
            'name' => $request->name,
            'package_id' => $request->get('package'),
            'salesforce_acct_id' => $request->salesforce_acct_id,
            'partner_id' => $request->get('partner')[0],
        ]);
        $school->addDistrict($request->districtsToAdd);
        $school->gradelevels()->attach($request->gradelevels);
        $school->save();

        return redirect(route('admin.schools.index', ['districtFilter' => $school->district->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('admin.school.edit', [
            'packages' => Package::all()->sortBy('name'),
            'school' => $school,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $school->update([
            'name' => $request->name,
            'package_id' => $request->package,
            'salesforce_acct_id' => $request->salesforce_acct_id,
            'license_status' => $request->boolean('license_status'),
        ]);

        if (! empty($request->studiosToRemove)) {
            $school->removeStudios($request->studiosToRemove);
        }

        if (! empty($request->studiosToAdd)) {
            $school->addStudios($request->studiosToAdd);
        }

        if (! empty($request->superFacilitatorsToRemove)) {
            $school->removeSuperFacilitators($request->superFacilitatorsToRemove);
        }

        if (! empty($request->superFacilitatorsToAdd)) {
            $school->addSuperFacilitators($request->superFacilitatorsToAdd);
        }

        if (! $request->boolean('license_status')) {
            School::destroy($school);
        }

        return redirect(route('admin.schools.index', ['districtFilter' => $school->district->id]));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect(route('admin.schools.index'));
        //not really a thing
    }
}
