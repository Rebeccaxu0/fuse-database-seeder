<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeCategory;
use Illuminate\Support\Facades\Auth;

class FacilitatorChallengesController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studio = Auth::user()->currentStudio;
        $packageChallengeIds = $studio->deFactoPackage->challenges->pluck('id');
        $eager = ['challengeVersions', 'challengeVersions.challengeCategory'];

        $viewData = [
            'activeChallenges' => $studio->activeChallenges->pluck('id')->all(),
            'challengeCategories' => ChallengeCategory::all(),
            'challenges' => Challenge::with($eager)->whereIn('id', $packageChallengeIds)
                ->get(),
            'studio' => $studio,
        ];

        return view('facilitator.challenges', $viewData);
    }
}
