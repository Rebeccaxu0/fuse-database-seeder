<?php

namespace App\View\Components;

use App\Models\Level;
use App\Models\User;
use Illuminate\View\Component;

class ProgressBarLevelStatus extends Component
{
    /**
     * Interactive flag
     */
    public bool $interactive;

    /**
     * Level
     *
     * @var Level
     */
    public Level $level;

    public string $status;

    /**
     * Create a new component instance.
     *
     * @param Level $level Level to render.
     *
     * @return void
     */
    public function __construct(bool $interactive, Level $level, User $user)
    {
        $this->interactive = $interactive;
        $this->level = $level;
        if ($user->completedLevel($level)) {
            $this->status = 'completed';
        }
        else if ($user->startedLevel($level)) {
            $this->status = 'started';
        }
        else {
            $this->status = 'unstarted';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.progress-bar-level-status');
    }
}
