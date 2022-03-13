<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use Illuminate\View\Component;

class InProgress extends Component
{
    public $challengeVersions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->challengeVersions = ChallengeVersion::all()->random(5);
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
