<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Package;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        // Full-page Livewire component - see App\Http\Livewire\Admin\SchoolsPage
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $district = $request->query('district');
        return view('admin.school.create', [
            'districtQueryValue' => $district,
            'districts' => District::with('package')->get()->sortBy('name'),
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
            'school' => $school,
        ]);
    }

    /**
     * Create new studios for a school.
     *
     *
     */
    public function addstudios(Request $request, School $school)
    {
        $validated = $request->validate([
            'createstudios' => 'required|array',
            'createstudios.*' => 'min:1|max:32',
        ]);

        $school->createStudios($validated['createstudios']);
        return redirect(route('admin.studios.index', ['school' => $school->id]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:schools|max:255',
            'district' => 'required|exists:App\Models\District,id',
            'package' => 'nullable|exists:App\Models\Package,id',
            'partner.*' => 'nullable|exists:App\Models\Partner,id',
            'gradelevels.*' => 'nullable|exists:App\Models\GradeLevel,id',
            'salesforce_acct_id' => 'nullable|string',
            'license_status' => 'nullable|boolean',
        ]);

        $schoolValues = [
            'name' => $validated['name'],
            'district_id' => $validated['district'],
        ];
        if (isset($validated['package'])) {
            $schoolValues['package_id'] = $validated['package'];
        }
        if (isset($validated['partner'])) {
            $schoolValues['partner_id'] = $validated['partner'][0];
        }
        if (isset($validated['salesforce_acct_id'])) {
            $schoolValues['salesforce_acct_id'] = $validated['salesforce_acct_id'];
        }
        if (isset($validated['license_status'])) {
            $schoolValues['status'] = 1;
        }
        $school = School::create($schoolValues);

        if (isset($validated['gradelevels'])) {
            $school->gradelevels()->attach($validated['gradelevels']);
        }

        return redirect(route('admin.studios.index', ['school' => $school->id]));
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
            'districts' => District::all()->sortBy('name'),
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
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('schools')->ignore($school->id),
                'max:255',
            ],
            'district' => 'required|exists:App\Models\District,id',
            'package' => 'nullable|exists:App\Models\Package,id',
            'partner.*' => 'nullable|exists:App\Models\Partner,id',
            'gradelevels.*' => 'nullable|exists:App\Models\GradeLevel,id',
            'salesforce_acct_id' => 'nullable|string',
            'license_status' => 'nullable|boolean',
            'facilitatorsToAdd' => 'nullable|exists:App\Models\User,id',
            'facilitatorsToRemove' => 'nullable|exists:App\Models\User,id',
            'studiosToAdd' => 'nullable|exists:App\Models\Studio,id',
            'studiosToRemove' => 'nullable|exists:App\Models\Studio,id',
        ]);

        $values = [];
        if ($school->name != $validated['name']) {
            $values['name'] = $validated['name'];
        }
        if ($school->district_id != $validated['district']) {
            $values['district_id'] = $validated['district'];
        }
        if ($school->package_id != $validated['package']) {
            $values['package_id'] = $validated['package'];
        }
        if ($school->salesforce_acct_id != $validated['salesforce_acct_id']) {
            $values['salesforce_acct_id'] = $validated['salesforce_acct_id'];
        }
        $license_status = ! array_key_exists('license_status', $validated);
        if ($school->status != $license_status) {
            $values['status'] = $license_status;
        }
        if (! empty($values)) {
            $school->update($values);
            $school->fresh();
        }

        if (array_key_exists('studiosToRemove', $validated)) {
            $school->removeStudios($validated['studiosToRemove']);
        }

        if (array_key_exists('studiosToAdd', $validated)) {
            $school->addStudios($validated['studiosToAdd']);
        }

        $facs = $school->users->pluck('id');
        $facsToRemove = null;
        if (array_key_exists('facilitatorsToRemove', $validated)) {
            $facsToRemove = $validated['facilitatorsToRemove'];
            $facs = $facs->filter(function ($value, $key) use ($facsToRemove) {
                return ! in_array($value, $facsToRemove);
            });
        }
        if (array_key_exists('facilitatorsToAdd', $validated)) {
            $facs = $facs->merge($validated['facilitatorsToAdd']);
        }
        $school->syncFacilitators($facs->toArray(), $facsToRemove);

        if (! $request->boolean('license_status')) {
            School::destroy($school);
        }

        return redirect(route('admin.studios.index', ['school' => $school->id]));
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
    }
}
