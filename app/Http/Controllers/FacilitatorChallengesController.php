<?php

namespace App\Http\Controllers;

use App\Enums\ChallengeStatus as Status;
use App\Models\ChallengeCategory;
use App\Models\ChallengeVersion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        Gate::allowIf(Auth::user()->isFacilitator());
        $studio = Auth::user()->activeStudio;
        $viewData = [
            'activeChallenges' => null,
            'betaChallenges' => null,
            'challenges' => null,
            'legacyChallenges' => null,
            'studio' => $studio,
        ];

        if ($studio->deFactoPackage) {
            $eager = ['challengeVersions', 'challengeVersions.challengeCategory'];

            $viewData['activeChallenges'] = $studio
                ->activeChallenges()
                ->pluck('id')
                ->all();
            $viewData['challengeCategories'] = ChallengeCategory::with($eager)
                ->get();
            $viewData['betaChallenges'] = ChallengeVersion::with(['challenge'])
                ->where('status', Status::Beta)
                ->get();
            $viewData['legacyChallenges'] = ChallengeVersion::with(['challenge'])
                ->where('status', Status::Legacy)
                ->get();
        }

        return view('facilitator.challenges', $viewData);
    }
}
