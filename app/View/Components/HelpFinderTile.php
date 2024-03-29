<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use App\Models\Studio;
use Illuminate\View\Component;

class HelpFinderTile extends Component
{
    /**
     * Challenge Version we're rendering.
     * @var ChallengeVersion
     */
    public ChallengeVersion $challengeVersion;

    /**
     * Studio from which to determine activity.
     */
    public Studio $studio;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ChallengeVersion $challengeVersion, Studio $studio)
    {
        $this->challengeVersion = $challengeVersion;
        $this->studio = $studio;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.help-finder-tile');
    }
}
