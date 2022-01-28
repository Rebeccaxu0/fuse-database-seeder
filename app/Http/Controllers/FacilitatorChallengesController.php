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
        $studio = Auth::user()->activeStudio;
        $packageChallengeIds = $studio->deFactoPackage->challenges->pluck('id');
        $eager = ['challengeVersions', 'challengeVersions.challengeCategory'];

        $viewData = [
            'activeChallenges' => $studio->activeChallenges->pluck('id')->all(),
            'primaryChallengeCategories' => ChallengeCategory::where('disapproved', 0)->get(),
            'secondaryChallengeCategories' => ChallengeCategory::where('disapproved', 1)->get(),
            'challenges' => Challenge::with($eager)->whereIn('id', $packageChallengeIds)
                ->get(),
            'studio' => $studio,
        ];

        return view('facilitator.challenges', $viewData);
    }
}
