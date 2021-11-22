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
        return view('admin.district.index', ['data' => District::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.district.create', ['packages' => Package::all()]);
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

        ]);
        $district->save();
        //$district->schools()->attach($request->schools);

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
            'packages' => Package::all(),
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
            'package' => $request->get('package'),
            'salesforce_acct_id' => $request->salesforce_acct_id,
        ]);
        $district->save();
        //$district->schools()->attach($request->schools);
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
