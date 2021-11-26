<?php

namespace App\Http\Controllers;

use App\Models\ChallengeVersion;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeVersionController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->authorizeResource(ChallengeVersion::class, 'challenge_version');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function student_index()
    {
        $challenges = Studio::find(Auth::user()->current_studio)->challengeVersions;
        return view('challenges', ['challenges' => $challenges]);
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
    public function edit(ChallengeVersion $challengeVersion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChallengeVersion $challengeVersion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChallengeVersion  $challengeVersion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChallengeVersion $challengeVersion)
    {
        //
    }
}
