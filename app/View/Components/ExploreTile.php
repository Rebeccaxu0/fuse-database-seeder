<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class ExploreTile extends Component
{
    public int $started = 0;
    public int $total = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $activeChallengeVersions = $user->activeStudio->challengeVersions;
        $this->total = $activeChallengeVersions->count();
        $this->started
            = $user->startedLevels
                   ->unique()
                   ->map(fn($level, $key) => $level->challengeVersion)
                   ->unique()
                   ->intersect($activeChallengeVersions)
                   ->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.explore-tile');
    }
}
