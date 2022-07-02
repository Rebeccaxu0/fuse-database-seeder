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
        $activeChallengeVersions = $user->activeStudio->activeChallenges();
        $this->total = $activeChallengeVersions->count();
        $this->started = $user->startedChallengeVersions()
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
