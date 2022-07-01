<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class InProgress extends Component
{
    public User $user;
    public $startedChallengeVersions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $activeChallengeVersions = $user->activeStudio->challengeVersions;
        $this->startedChallengeVersions =
            Cache::remember("u{$user->id}_in_progress_challenge_versions", 3600, function () use ($user, $activeChallengeVersions) {
            return $user->startedChallengeVersions()
                   ->filter(fn($cv, $key) => ! $user->hasCompletedChallengeVersion($cv))
                   ->intersect($activeChallengeVersions)
                   ->sortBy('name');
        // TODO: Add ideas?
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.in-progress');
    }
}
