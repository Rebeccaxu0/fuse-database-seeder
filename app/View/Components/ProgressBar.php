<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use Illuminate\View\Component;

class ProgressBar extends Component
{
    public bool $interactive = true;
    public ChallengeVersion $challengeVersion;

    /**
     * Create a new component instance.
     *
     * @param ChallengeVersion $challenge_version Challenge Version
     *
     * @return void
     */
    public function __construct(ChallengeVersion $challengeVersion, bool $interactive = true)
    {
        $this->interactive = $interactive;
        $this->challengeVersion = $challengeVersion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->challengeVersion->levels);
        return view('components.progress-bar');
    }
}
