<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use App\Rules\WistiaCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
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
        return view('student.challenges', ['studio' => Auth::user()->activeStudio]);
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
        return view('admin.challengeversion.create', [
            'challenge' => $challenge,
            'categories' => ChallengeCategory::all()->sortBy('name'),
            'challenges' => Challenge::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ChallengeVersion $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ChallengeVersion $challengeversion)
    {
        $validated = $request->validate([
            'name' => 'required|unique:challenge_versions|max:255',
            'challenge_id' => 'required',
            'category_id' => 'required',
            'infoUrl' => 'nullable|url',
            'wistiaId' => ['nullable', new WistiaCode],
        ]);

        $gallery_thumbnail_url = null;
        if ($request->wistiaId) {
            $wistia = Http::acceptJson()
                ->withToken(config('wistia.token'))
                ->get('https://api.wistia.com/v1/medias/' . $request->wistiaId);
            $gallery_thumbnail_url = $wistia->json('thumbnail.url');
        }

        $challengeversion = ChallengeVersion::create([
            'blurb' => $request->blurb,
            'challenge_category_id' => $request->category_id,
            'challenge_id' => $request->challenge_id,
            'chromebook_info' => $request->chromebookInfo,
            'gallery_note' => $request->galleryNote,
            'gallery_wistia_video_id' => $request->wistiaId,
            'gallery_thumbnail_url' => $gallery_thumbnail_url,
            'info_article_url' => $request->infoUrl,
            'name' => $request->name,
            'prerequisite_challenge_version_id' => $request->prereqChallengeVersion,
            'slug' => Str::of($request->name)->slug('-'),
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
        $validated = $request->validate([
            'name' => 'required|unique:challenge_versions|max:255',
            'challenge_id' => 'required',
            'category_id' => 'required',
            'infoUrl' => 'nullable|url',
            'wistiaId' => ['nullable', new WistiaCode],
        ]);

        $gallery_thumbnail_url = null;
        if ($request->wistiaId) {
            $wistia = Http::acceptJson()
                ->withToken(config('wistia.token'))
                ->get('https://api.wistia.com/v1/medias/' . $request->wistiaId);
            $gallery_thumbnail_url = $wistia->json('thumbnail.url');
        }

        $challengeversion->update([
            'blurb' => $request->blurb,
            'challenge_category_id' => $request->category_id,
            'challenge_id' => $request->challenge_id,
            'chromebook_info' => $request->chromeInfo,
            'gallery_note' => $request->galleryNote,
            'gallery_wistia_video_id' => $request->wistiaId,
            'gallery_thumbnail_url' => $gallery_thumbnail_url,
            'info_article_url' => $request->infoUrl,
            'name' => $request->name,
            'prerequisite_challenge_version_id' => $request->prereqChallengeVersion,
            'slug' => Str::of($request->name)->slug('-'),
        ]);

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
        $challengeversion->delete();
        return redirect(route('admin.challenges.index'));
    }
}
