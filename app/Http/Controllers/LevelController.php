<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartLevelRequest;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
                $fields['whats_next_text'] = $level->next()->blurb;
                $fields['whats_next_route'] = route('student.level',
                    [
                        'challengeVersion' => $level->levelable,
                        'level' => $level->next(),
                    ]);
            }
            return view('student.level-started', ['level' => $level, 'fields' => $fields]);
        }

        // Default is to restrict the level.
        $available = Auth::user()->isAdmin()
            || Auth::user()->activeStudio->activeChallenges->contains($challengeVersion);
        $startable = $level->isStartable(Auth::user());
        $prerequisite_text = $prerequisite_route = '';

        if (! $startable) {
            if ($challengeVersion->challenge->prerequisiteChallenge
                && ! $challengeVersion->challenge->prerequisiteChallenge->isCompleted(Auth::user())) {
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
                        = __('You must complete :prerequisite_challenge to unlock this challenge.',
                        ['prerequisite_challenge' => $challengeVersion->challenge->prerequisiteChallenge->name]);
                    $prerequisite_route = route('student.level',
                        [
                            'challengeVersion' => $prerequisiteChallengeVersion,
                            'level' => $prerequisiteChallengeVersion->levels->last(),
                        ]);
                }
            }
            else {
                $prerequisite_text
                  = __('You must complete level :number to unlock this level.',
                    ['number' => $level->previous()->level_number]);
                $prerequisite_route = route('student.level',
                  [
                    'challengeVersion' => $challengeVersion,
                    'level' => $level->previous(),
                  ]);
            }
        }

        return view('student.level-unstarted',
            [
              'level' => $level,
              'available' => $available,
              'startable' => $startable,
              'prerequisite_text' => $prerequisite_text,
              'prerequisite_route' => $prerequisite_route,
            ]);
    }

    /**
     * Start the requested level, if startable.
     */
    public function start(StartLevelRequest $request, ChallengeVersion $challengeVersion, Level $level)
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
    public function edit(Level $level)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        //
    }
}
