<?php

namespace App\Http\Controllers;

use App\Models\ChallengeCategory;
use Illuminate\Http\Request;

class ChallengeCategoryController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ChallengeCategory::class, 'challengecategory');
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
     * @param  \App\Models\ChallengeCategory  $challengeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ChallengeCategory $challengeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChallengeCategory  $challengeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChallengeCategory $challengeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChallengeCategory  $challengeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChallengeCategory $challengeCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChallengeCategory  $challengeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChallengeCategory $challengeCategory)
    {
        //
    }
}
