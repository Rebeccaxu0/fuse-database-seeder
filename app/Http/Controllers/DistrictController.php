<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Package;
use App\Models\School;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->authorizeResource(District::class, 'district');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $districts = District::with(['schools', 'package'])
        ->get()->sortBy('name');
      return view('admin.district.index', ['districts' => $districts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.district.create', [
        'packages' => Package::all()->sortBy('name'),
      ]);
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
            'name' => 'required|unique:districts|max:255',
        ]);

        $district = District::create([
            'name' => $request->name,
            'package_id' => $request->get('package'),
            'salesforce_acct_id' => $request->salesforce_acct_id,
            'license_status' => $request->boolean('license_status')
        ]);
        // $district->schools()->saveMany($request->schools);

        return redirect(route('admin.districts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        return view('admin.district.edit', [
            'packages' => Package::all()->sortBy('name'),
            'district' => $district,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $district->update([
            'name' => $request->name,
            'package_id' => $request->package,
            'salesforce_acct_id' => $request->salesforce_acct_id,
            'license_status' => $request->boolean('license_status'),
        ]);
        if ($request->schoolsremove){
          foreach ($district->schools as $school) {
              if (in_array($school->id, $request->schoolsremove)) {
                $school->district()->dissociate();
                $school->save();
              }
          }
        }
        if ($request->facilitatorsremove){
          foreach ($district->superFacilitators as $user) {
            if (in_array($user->id, $request->facilitatorsremove)) {
              $user->district()->dissociate();
              if(!$user->districts()){
                $user->save();
              }
              else {
              #tbd event: “Oh you’re a super facilitator, but you’re not a member of district anymore? 
              #Then I guess you’re not a super facilitator anymore” 
              }
            }
          }
        }
        return redirect(route('admin.districts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        return redirect(route('admin.districts.index'));
        //not really a thing
    }
}
