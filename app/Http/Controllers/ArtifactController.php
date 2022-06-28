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
        $artifacts = $user->artifacts()->paginate(12);
        return view('student.my_stuff', ['artifacts' => $artifacts, 'studio' => $user->activeStudio]);
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
            Cache::forever("u{$teammate->id}_current_level_on_levelable_{$level->levelable->id}", $level);
            if ($validated['type'] == 'complete') {
                Cache::put("u{$teammate->id}_has_completed_level_{$level->id}", true);
            }
        }

        switch ($validated['type']) {
        case 'save':
            $destination = URL::previous();
            break;

        case 'complete':
            if ($level->next()) {
                $params = [
                    'challengeVersion' => $level->next()->levelable,
                    'level' => $level->next(),
                ];
                $destination = route('student.level', $params);
            }
            else {
                $destination = route('student.challenges');
            }
            break;

        }
        return redirect($destination)->with('status', __('Save successful!'));
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
        //
    }
}
