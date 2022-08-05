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
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Level::class, 'level');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::where('levelable_type', '<>', 'idea')
            ->has('levelable')
            ->get()
            ->sortBy('name');
        return view('admin.level.index', ['levels' => $levels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $challengeVersion = $request->input('challengeVersion');
        $challengeVersions = ChallengeVersion::all()->sortBy('name');
        return view('admin.level.create', [
            'challengeVersion' => $challengeVersion,
            'challengeVersions' => $challengeVersions,
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
        $validated = $request->validate([
            'blurb' => 'nullable|string',
            'challengeDesc' => 'nullable|string',
            'facilitatorNotes' => 'nullable|string',
            'getHelp' => 'nullable|string',
            'getStarted' => 'nullable|string',
            'howToComplete' => 'nullable|string',
            'levelable_id' => 'required|exists:App\Models\ChallengeVersion,id',
            'powerUp' => 'nullable|string',
            'stuffYouNeed' => 'nullable|string',
        ]);

        $challengeVersion = ChallengeVersion::find($validated['levelable_id']);
        $level = Level::create([
            'levelable_id' => $validated['levelable_id'],
            'levelable_type' => ChallengeVersion::class,
            'blurb' => $validated['blurb'],
            'challenge_desc' => $validated['challengeDesc'],
            'facilitator_notes_desc' => $validated['facilitatorNotes'],
            'get_help_desc' => $validated['getHelp'],
            'get_started_desc' => $validated['getStarted'],
            'how_to_complete_desc' => $validated['howToComplete'],
            'level_number' => $challengeVersion->levels->count() + 1,
            'power_up_desc' => $validated['powerUp'],
            'stuff_you_need_desc' => $validated['stuffYouNeed'],
        ]);

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
            $icon_fields = [
                'get_started_desc',
                'how_to_complete_desc',
                'power_up_desc',
                'facilitator_notes_desc',
                'get_help_desc',
            ];
            foreach ($icon_fields as $icon_field) {
                $fields[$icon_field] = Blade::render($level->$icon_field);
            }

            if ($next = $level->next()) {
                $fields['whats_next_text'] = $next->blurb;
                $fields['whats_next_route'] = route('student.level', [$level->levelable, $next]);
            }
            else {
                $fields['whats_next_text'] = __('Choose a new Challenge!');
                $fields['whats_next_route'] = route('student.challenges');
            }

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
            $view = 'student.level-started';
            $params = [
                'challengeVersion' => $challengeVersion,
                'fields' => $fields,
                'level' => $level,
                'studio' => Auth::user()->activeStudio,
            ];
        }
        else {
            // Default is to restrict the level.
            $available = Auth::user()->isAdmin()
                || Auth::user()->activeStudio->activeChallenges()->contains($challengeVersion);
            $startable = $level->isStartable(Auth::user());
            $prerequisite_text = $prerequisite_route = '';

            if (! $startable) {
                // If incomplete prerequisite challenge...
                if ($challengeVersion->challenge->prerequisiteChallenge
                    && ! $challengeVersion->challenge->prerequisiteChallenge->isCompleted(Auth::user())) {
                    $prerequisiteChallengeVersion
                        = Auth::user()
                            ->activeStudio
                            ->activeChallenges()
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
                else if ($level->previous()) {
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
                else {
                    $prerequisite_text = __("Sorry, you can't start this level.");
                    $prerequisite_route = route('student.challenges');
                }
            }
            $view = 'student.level-unstarted';
            $params = [
                'level' => $level,
                'available' => $available,
                'startable' => $startable,
                'prerequisite_text' => $prerequisite_text,
                'prerequisite_route' => $prerequisite_route,
            ];
        }

        return view($view, $params);
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
        $validated = $request->validate([
            'blurb' => 'nullable|string',
            'challengeDesc' => 'nullable|string',
            'facilitatorNotes' => 'nullable|string',
            'getHelp' => 'nullable|string',
            'getStarted' => 'nullable|string',
            'howToComplete' => 'nullable|string',
            'powerUp' => 'nullable|string',
            'stuffYouNeed' => 'nullable|string',
        ]);

        $level->update([
            'blurb' => $request->blurb,
            'challenge_desc' => $request->challengeDesc,
            'facilitator_notes_desc' => $request->facilitatorNotes,
            'get_help_desc' => $request->getHelp,
            'get_started_desc' => $request->getStarted,
            'how_to_complete_desc' => $request->howToComplete,
            'levelable_id' => $request->levelable_id,
            'power_up_desc' => $request->powerUp,
            'stuff_you_need_desc' => $request->stuffYouNeed,
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
        $newLevel = $level
            ->replicate([
                'id',
                'level_number',
            ])
            ->fill([
                'blurb' => 'COPY - ' . $level->blurb,
                'level_number' => $level->levelable->levels->count() + 1,
            ]);
        $newLevel->save();

        return redirect(route('admin.levels.edit', $newLevel));
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
