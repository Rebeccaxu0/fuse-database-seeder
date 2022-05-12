<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChallengeVersionController extends Controller
{
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
        return view('admin.challengeversion.create', [
            'challenge' => $challenge,
            'categories' => ChallengeCategory::all()->sortBy('name'),
            'challenges' => Challenge::all()->sortBy('name'),
        ]);
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
            'challenge_id' => 'required',
            'category_id' => 'required',
        ]);


        $challengeversion = ChallengeVersion::create([
            'name' => $request->name,
            'challenge_id' => $request->challenge_id,
            'challenge_category_id' => $request->category_id,
            'blurb' => $request->blurb,
            'prerequisite_challenge_version_id' => $request->prereqchal,
            'slug' => Str::of($request->name)->slug('-'),
            'info_article_url' => $request->infourl,
        ]);

        return redirect(route('admin.challengeversions.index'));
    }

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
        return view('admin.challengeversion.edit', [
            'challengeversion' => $challengeversion,
            'categories' => ChallengeCategory::all()->sortBy('name'),
            'challenges' => Challenge::all()->sortBy('name'),
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
        $request->flash();
        $validated = $request->validate([
            'name' => 'required|unique:challenge_versions|max:255',
            'challenge_id' => 'required',
            'category_id' => 'required',
        ]);

        $challengeversion->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'challenge_id' => $request->challenge_id,
            'challenge_category_id' => $request->category_id,
            'gallery_version_desc_short' => $request->versiondesc,
            'blurb' => $request->blurb,
            'summary' => $request->summary,
            'stuff_you_need' => $request->stuffyouneed,
            'facilitator_notes' => $request->facnotes,
            'chromebook_info' => $request->chromeinfo,
            'prerequisite_challenge_version_id' => $request->prereqchal,
            'info_article_url' => $request->infourl,
        ]);

        $challengeversion->setLevelsOrder($request->level);
        return redirect(route('admin.challenges.index'));
    }

    /**
     * Copy the challenge version and allow user to edit from there.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChallengeVersion $challengeversion
     * @return \Illuminate\Http\Response
     */
    public function copy(Request $request, ChallengeVersion $challengeversion)
    {
        $newchallengeversion = ChallengeVersion::create([
            'name' => $challengeversion->name,
            'slug' => Str::of($challengeversion->name)->slug('-'),
            'challenge_id' => $challengeversion->challenge_id,
            'challenge_category_id' => $challengeversion->category_id,
            'gallery_version_desc_short' => $challengeversion->versiondesc,
            'blurb' => $challengeversion->blurb,
            'summary' => $challengeversion->summary,
            'stuff_you_need' => $challengeversion->stuffyouneed,
            'facilitator_notes' => $challengeversion->facnotes,
            'chromebook_info' => $challengeversion->chromeinfo,
            'prerequisite_challenge_version_id' => $challengeversion->prereqchal,
            'info_article_url' => $challengeversion->infourl,
        ]);

        $newchallengeversion->setLevelsOrder($challengeversion->level);
        return redirect(route('admin.challengeversions.index'));
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
