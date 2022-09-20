<?php

namespace App\Http\Controllers;

use App\Enums\ChallengeStatus as Status;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ChallengeController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Challenge::class, 'challenge');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $betaChallenges = Challenge::with(['challengeVersions'])
            ->where('status', Status::Beta)
            ->get()
            ->sortBy('name');
        $challenges = Challenge::with(['challengeVersions'])
            ->where('status', Status::Current)
            ->get()
            ->sortBy('name');
        $legacyChallenges = Challenge::with(['challengeVersions'])
            ->where('status', Status::Legacy)
            ->get()
            ->sortBy('name');
        $archiveChallenges = Challenge::with(['challengeVersions'])
            ->where('status', Status::Archive)
            ->get()
            ->sortBy('name');
        return view('admin.challenge.index', [
            'betaChallenges' => $betaChallenges,
            'challenges' => $challenges,
            'legacyChallenges' => $legacyChallenges,
            'archiveChallenges' => $archiveChallenges,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.challenge.create');
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
        $validated = $request->validate([
            'name' => 'required|unique:challenges|max:255',
        ]);

        $challenge = Challenge::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect(route('admin.challenges.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        $statuses = array_map(
            fn($status) => (object) [
                    'id' => $status->value,
                    'name' => $status->label(),
                ],
                Status::cases()
            );
        return view('admin.challenge.edit', [
            'challenge' => $challenge,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => [new Enum(Status::class)],
        ]);
        $challenge->update($validated);

        return redirect(route('admin.challenges.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        $challenge->delete();
        return redirect(route('admin.challenges.index'));
    }
}
