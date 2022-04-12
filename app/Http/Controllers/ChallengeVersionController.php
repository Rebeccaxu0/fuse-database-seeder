<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChallengeVersionController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     
    public function __construct()
    {
        $this->authorizeResource(ChallengeVersion::class, 'challenge_version');
    }
    */

    /**
     * Display a customized listing of the resource for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function student_index()
    {
        // TODO: Add logic to account for Alumni/Freemium accounts.
        $activeStudio = Auth::user()->activeStudio;
        $challengeVersions = $activeStudio ? $activeStudio->challengeVersions->sortBy('name') : [];
        return view('student.challenges', ['challengeVersions' => $challengeVersions]);
    }

    /**
     * Display a customized listing of the resource for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function student_help_finder()
    {
        // TODO: Add logic to account for Alumni/Freemium accounts.
        $activeStudio = Auth::user()->activeStudio;
        $challengeVersions = $activeStudio ? $activeStudio->challengeVersions->sortBy('name') : [];
        return view('student.help_finder', ['challenges' => $challengeVersions, 'studio' => $activeStudio]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challengeversions = ChallengeVersion::all()->sortBy('name');
        return view('admin.challengeversion.index', ['challengeversions' => $challengeversions]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Challenge $challenge)
    {
        return view('admin.challengeversions.create', ['challenge' => $challenge]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Challenge $challenge)
    {
        $request->flash();
        $validated = $request->validate([
            'name' => 'required|unique:challenge_versions|max:255',
        ]);


        $challengeversion = ChallengeVersion::create([
            'name' => $request->name,
            'challenge_id' => $challenge->id,
            'challenge_category_id' => $request->category_id,
            'blurb' => $request->blurb,
            'prerequisite_challenge_version_id' => $request->prereqchal,
            'slug' => Str::of($request->name)->slug('-'),
            'info_article_url' => $request->infourl
        ]);

        return redirect(route('admin.challengeversions.index'));
    } 
/*
    public function store(Request $request)
    {
        $request->flash();
        $validated = $request->validate([
            'name' => 'required|unique:challengeversions|max:255',
        ]);

        $challengeversion = ChallengeVersion::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect(route('admin.challenges.index'));
    }

*/
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function show(ChallengeVersion $challengeVersion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function edit(ChallengeVersion $challengeversion)
    {
        return view('admin.challengeversions.edit', [
            'version' => $challengeVersion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChallengeVersion $challengeversion)
    {
        $challengeVersion->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect(route('admin.challenges.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChallengeVersion $challengeversion)
    {
        $challengeversion->delete();
        return redirect(route('admin.challenges.index'));
    }
}
