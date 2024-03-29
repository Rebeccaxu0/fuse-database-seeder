<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelSaveOrCompleteRequest;
use App\Models\Artifact;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class ArtifactController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Artifact::class, 'artifact');
    }

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
     * Display a customized listing of the resource for students.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function artifact_gallery(User $user = null)
    {
        if (auth()->user() == $user) {
            $title = __("My Stuff");
        }
        else {
            $title = __(":username's Stuff", ['username' => $user->name]);
        }
        // TODO: May need to refactor. This generates a pretty slow query.
        // TODO: if we want to eager load 'level.levelable.challenge', we need
        // to refactor Ideas to have a dummy parent challenge.
        $artifacts = $user->artifacts()
                          ->has('level.levelable')
                          ->with('level', 'level.levelable', 'comments', 'users', 'media')
                          ->orderBy('created_at', 'desc')
                          ->paginate(12);
        return view('student.my_stuff', [
            'artifacts' => $artifacts,
            'mystuffUser' => $user,
            'studio' => $user->activeStudio,
            'title' => $title,
        ]);
    }

    /**
     * Display a customized listing of the resource for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_stuff_index()
    {
        return $this->artifact_gallery(Auth::user());
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
    public function store(LevelSaveOrCompleteRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($validated['uid']);
        $team[] = $user;
        $level = Level::find($validated['lid']);
        $artifact = new Artifact;
        $artifact->level_id = $validated['lid'];
        $artifact->type = $validated['type'];
        $artifact->name = $validated['name'];
        $artifact->notes = $validated['notes'];
        $artifact->url = $validated['url'];

        if ($validated['teammates']) {
            $students = $user->activeStudio->students;
            foreach ($validated['teammates'] as $teammate) {
                if ($students->contains($teammate)) {
                    $team[] = User::find($teammate);
                }
            }
        }

        if ($validated['uploadcode']) {
            // TODO: convert to a file instance.
        }
        $artifact->save();
        $artifact->team()->saveMany($team);
        foreach ($team as $teammate) {
            if ($level->levelable::class == ChallengeVersion::class) {
                Cache::put("u{$teammate->id}_current_level_on_challengeversion_{$level->levelable->id}", $level, 1800);
            }
            if ($validated['type'] == 'complete') {
                Cache::put("u{$teammate->id}_has_completed_level_{$level->id}", true, 1800);
                if ($next = $level->next()) {
                    Cache::put("u{$teammate->id}_can_start_level_{$next->id}", true, 1800);
                }
            }
        }

        switch ($validated['type']) {
        case 'save':
            $message = __('Save successful!');
            $destination = URL::previous();
            break;

        case 'complete':
            if ($level->next()) {
                $params = [
                    'challengeVersion' => $level->next()->levelable,
                    'level' => $level->next(),
                ];
                $message = __("Great Job! You've leveled up!");
                $destination = route('student.level', $params);
            }
            else {
                $message = __("Great Job! You've finished a challenge!");
                $destination = route('student.challenges');
            }
            break;

        }
        return redirect($destination)->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function show(Artifact $artifact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function edit(Artifact $artifact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artifact $artifact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artifact $artifact)
    {
        $message = "Artifact '{$artifact->name}' deleted";
        $artifact->delete();
        return redirect(URL::previous())
            ->with('status', $message);
    }
}
