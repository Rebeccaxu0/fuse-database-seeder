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

        $activeChallengeVersions = $user->activeStudio->activeChallenges();
        $this->startedChallengeVersions =
            Cache::remember("u{$user->id}_in_progress_challenge_versions", 1800, function () use ($user, $activeChallengeVersions) {
                return $user->activeStudio->activeChallenges()
                   ->filter(fn($cv, $key) => $user->hasStartedChallengeVersion($cv))
                   ->filter(fn($cv, $key) => ! $user->hasCompletedChallengeVersion($cv))
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
