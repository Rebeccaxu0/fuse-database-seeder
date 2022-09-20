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
            $packageChallenges = $studio->deFactoPackage->challenges;
            $packageChallegeIds = $packageChallenges->pluck('id')->all();
            $packageChallengeVersions = ChallengeVersion::with(['challenge', 'challengeCategory'])
                ->whereHas('challenge', function ($q) use ($packageChallegeIds) {
                    $q->whereIn('id', $packageChallegeIds);
                })
                ->get();

            $viewData['activeChallenges'] = $studio
                ->activeChallenges()
                ->pluck('id')
                ->all();
            $viewData['challengeCategories'] = ChallengeCategory::all();
            foreach ($viewData['challengeCategories'] as $category) {
                $category->cvlist = $packageChallengeVersions->filter(function ($v, $k) use ($category) {
                    return $v->challengeCategory == $category && $v->status == Status::Current;
                })
                ->sortBy('challenge.name');
            }
            $viewData['betaChallenges'] = $packageChallengeVersions->where('status', Status::Beta)
                ->sortBy('challenge.name');
            $viewData['legacyChallenges'] = $packageChallengeVersions->where('status', Status::Legacy)
                ->sortBy('challenge.name');
        }

        return view('facilitator.challenges', $viewData);
    }
}
