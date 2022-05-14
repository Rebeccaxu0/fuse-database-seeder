<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelStartRequest;
use App\Models\ChallengeVersion;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all()->sortBy('name');
        return view('admin.level.index', ['levels' => $levels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = ChallengeVersion::all()->sortBy('name');
        return view('admin.level.create', ['parents' => $parents]);
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

        $level = Level::create([
            'levelable_id' => $request->levelable_id,
            'levelable_type' => ChallengeVersion::class,
            'blurb' => $request->blurb,
            'challenge_desc' => $request->challenge_desc,
            'stuff_you_need_desc' => $request->syn_desc,
            'get_started_desc' => $request->gs_desc,
            'how_to_complete_desc' => $request->htc_desc,
            'get_help_desc' => $request->gh_desc,
            'power_up_desc' => $request->pu_desc,
        ]);

        $level->save;

        $order = [];
        $i = 0;
        $order[$level->id] = $i;
        foreach ($level->levelable->levels()->get() as $level) {
            $i++;
            $order[$level->id] = $i;
        }
        $level->level_number = $level->levelable->setLevelsOrder($order);
        $level->save;

        return redirect(route('admin.challengeversions.edit', $request->levelable_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ChallengeVersion $challengeVersion, Level $level)
    {
        // If a student has started this level, use started level template.
        if (Auth::user()->hasStartedLevel($level)) {
            // Run certain fields through Blade::render() to get our icons.
            $icon_fields = ['get_started_desc', 'how_to_complete_desc', 'power_up_desc', 'get_help_desc'];
            foreach ($icon_fields as $icon_field) {
                $fields[$icon_field] = Blade::render($level->$icon_field);
            }
            $fields['whats_next_text'] = __('Choose a new Challenge!');
            $fields['whats_next_route'] = route('student.challenges');
            if ($level->next()) {
                $whats_next['text'] = $level->next()->blurb;
                $whats_next['route'] = route(
                    'student.level',
                    [
                        'challengeVersion' => $level->levelable,
                        'level' => $level->next(),
                    ]
                );
            }
            return view('student.level-started', ['level' => $level, 'fields' => $fields]);
        }

        // Default is to restrict the level.
        $available = Auth::user()->isAdmin()
            || Auth::user()->activeStudio->activeChallenges->contains($challengeVersion);
        $startable = $level->isStartable(Auth::user());
        $prerequisite_text = $prerequisite_route = '';

        if (! $startable) {
            if (
                $challengeVersion->challenge->prerequisiteChallenge
                && ! $challengeVersion->challenge->prerequisiteChallenge->isCompleted(Auth::user())
            ) {
                $prerequisiteChallengeVersion
                    = Auth::user()
                    ->activeStudio
                    ->activeChallenges
                    ->intersect(
                        $challengeVersion
                            ->challenge
                            ->prerequisiteChallenge
                            ->challengeVersions
                    )
                    ->first();
                if (! $prerequisiteChallengeVersion) {
                    $available = false;
                }
                else {
                    $prerequisite_text
                        = __(
                            'You must complete :prerequisite_challenge to unlock this challenge.',
                            ['prerequisite_challenge' => $challengeVersion->challenge->prerequisiteChallenge->name]
                        );
                    $prerequisite_route = route(
                        'student.level',
                        [
                            'challengeVersion' => $prerequisiteChallengeVersion,
                            'level' => $prerequisiteChallengeVersion->levels->last(),
                        ]
                    );
                }
            }
            else {
                $prerequisite_text
                    = __(
                        'You must complete level :number to unlock this level.',
                        ['number' => $level->previous()->level_number]
                    );
                $prerequisite_route = route(
                    'student.level',
                    [
                        'challengeVersion' => $challengeVersion,
                        'level' => $level->previous(),
                    ]
                );
            }
        }

        return view(
            'student.level-unstarted',
            [
                'level' => $level,
                'available' => $available,
                'startable' => $startable,
                'prerequisite_text' => $prerequisite_text,
                'prerequisite_route' => $prerequisite_route,
            ]
        );
    }

    /**
     * Start the requested level, if startable.
     */
    public function start(LevelStartRequest $request, ChallengeVersion $challengeVersion, Level $level)
    {
        $level->start(Auth::user());
        return redirect()->route('student.level', ['challengeVersion' => $challengeVersion, 'level' => $level]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Level $level)
    {
        return view('admin.level.edit', [
            'level' => $level,
            'copy' => $request->session()->get('prev'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $level->update([
            'levelable_id' => $request->levelable_id,
            'levelable_type' => ChallengeVersion::class,
            'blurb' => $request->blurb,
            'challenge_desc' => $request->challengeDesc,
            'stuff_you_need_desc' => $request->stuffYouNeed,
            'get_started_desc' => $request->getStarted,
            'how_to_complete_desc' => $request->howToComplete,
            'get_help_desc' => $request->getHelp,
            'power_up_desc' => $request->powerUp,
        ]);
        if ($request->session()->get('prev') == 'Copy of') {
            $request->session()->forget('prev');
            return redirect(route('admin.challengeversions.edit', $request->levelable_id));
        }
        else {
            $request->session()->forget('prev');
            return redirect(route('admin.challengeversions.index'));
        }
    }

    /**
     * Copy the level and allow user to edit from there.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function copy(Request $request, Level $level)
    {
        $newlevel = Level::create([
            'levelable_id' => $level->levelable_id,
            'levelable_type' => ChallengeVersion::class,
            'blurb' => $level->blurb,
            'challenge_desc' => $level->challenge_desc,
            'stuff_you_need_desc' => $level->syn_desc,
            'get_started_desc' => $level->gs_desc,
            'how_to_complete_desc' => $level->htc_desc,
            'get_help_desc' => $level->gh_desc,
            'power_up_desc' => $level->pu_desc,
        ]);

        $order = [];
        $i = 0;
        foreach ($newlevel->levelable->levels()->get() as $level) {
            $i++;
            $order[$level->id] = $i;
        }
        $newlevel->levelable->setLevelsOrder($order);
        $newlevel->save();
        $request->session()->put('prev', 'Copy of');

        return redirect(route('admin.levels.edit', $newlevel));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
        return redirect(route('admin.challengeversions.index'));
    }
}
