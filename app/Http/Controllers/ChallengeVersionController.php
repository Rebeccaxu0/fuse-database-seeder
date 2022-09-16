<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateChallengeVersionRequest as SaveCVRequest;
use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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
        $challengeVersions = Auth::user()->activeStudio->activeChallenges();
        return view('student.challenges', ['challengeVersions' => $challengeVersions]);
    }

    /**
     * Display a customized listing of the resource for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function student_help_finder()
    {
        return view('student.help_finder', ['studio' => Auth::user()->activeStudio]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::allowIf(Auth::user()->isAdmin());
        $challengeCategories = ChallengeCategory::with('challengeVersions')
            ->orderBy('name')
            ->get();
        [$disapproved, $approved] = $challengeCategories->partition(function($category) {
            return $category->disapproved;
        });
        $categories = $approved->union($disapproved);
        return view('admin.challengeversion.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Challenge $challenge)
    {
        Gate::allowIf(Auth::user()->isAdmin());
        return view('admin.challengeversion.create', [
            'challenge' => $challenge,
            'categories' => ChallengeCategory::all()->sortBy('name'),
            'challenges' => Challenge::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\http\Requests\StoreOrUpdateChallengeVersionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCVRequest $request)
    {
        $validated = $request->validated();

        $validated = $this->populateDependentFields($validated);

        ChallengeVersion::create($validated);

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
        Gate::allowIf(Auth::user()->isAdmin());
        return view('admin.challengeversion.edit', [
            'challengeversion' => $challengeversion,
            'categories' => ChallengeCategory::all()->sortBy('name'),
            'challenges' => Challenge::all()->sortBy('name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrUpdateChallengeVersionRequest  $request
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCVRequest $request, ChallengeVersion $challengeversion)
    {
        $validated = $request->validated();

        $validated = $this->populateDependentFields($validated);

        $challengeversion->update($validated);

        if ($request->level) {
            $challengeversion->setLevelsOrder($request->level);
        }
        return redirect(route('admin.challengeversions.index'));
    }

    /**
     * Copy the challenge version and allow user to edit from there.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChallengeVersion $challengeversion
     * @return \Illuminate\Http\Response
     */
    public function copy(Request $request, ChallengeVersion $challengeVersion)
    {
        Gate::allowIf(Auth::user()->isAdmin());
        $newChallengeVersion = $challengeVersion
            ->replicate(['id'])
            ->fill(['name' => $challengeVersion->name . ' COPY']);
        $newChallengeVersion->save();

        $newChallengeVersion->setLevelsOrder($challengeVersion->level);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array $validated
     * @return array
     */
    private function populateDependentFields($validated)
    {
        $validated['slug'] = Str::slug($validated['name']);
        $validated['gallery_thumbnail_url'] = null;
        if ($validated['gallery_wistia_video_id']) {
            $wistiaResponse = Http::acceptJson()
                ->withToken(config('wistia.token'))
                ->get('https://api.wistia.com/v1/medias/' . $validated['gallery_wistia_video_id']);
            $validated['gallery_thumbnail_url'] = $wistiaResponse->json('thumbnail.url');
        }
        return $validated;
    }
}
