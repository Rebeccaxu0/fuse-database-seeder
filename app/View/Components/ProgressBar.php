<?php

namespace App\View\Components;

use App\Models\ChallengeVersion;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProgressBar extends Component
{
    public bool $interactive = true;
    public ChallengeVersion|Idea|null $levelable = null;
    public ?Collection $levels = null;

    /**
     * Create a new component instance.
     *
     * @param ChallengeVersion $challenge_version Challenge Version
     *
     * @return void
     */
    public function __construct(ChallengeVersion|Idea|null $levelable, User $user, bool $interactive = true)
    {
        if (! is_null($levelable)) {
            $this->interactive = $interactive;
            $this->levelable = $levelable;
            $this->levels = $this->levelable->levels->sortBy('level_number');
            foreach ($this->levels as $level) {
                if ($user->hasCompletedLevel($level)) {
                    $level->status = 'completed';
                } else if ($user->hasStartedLevel($level)) {
                    $level->status = 'started';
                } else {
                    $level->status = 'unstarted';
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (is_null($this->levelable) || is_null($this->levels)) {
            return;
        }

        return view('components.progress-bar');
    }
}
