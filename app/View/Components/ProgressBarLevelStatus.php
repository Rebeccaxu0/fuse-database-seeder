<?php

namespace App\View\Components;

use App\Models\Level;
use Illuminate\View\Component;

class ProgressBarLevelStatus extends Component
{
    /**
     * Undocumented variable
     *
     * @var Level
     */
    public $level;

    /**
     * Create a new component instance.
     *
     * @param Level $level Level to render.
     *
     * @return void
     */
    public function __construct(Level $level)
    {
        $this->level = $level;
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
