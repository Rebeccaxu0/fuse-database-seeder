<?php

namespace App\View\Components;

use App\Models\Level;
use App\Models\User;
use Illuminate\View\Component;

class DashboardStatus extends Component
{
    public Level $level;
    public User $user;
    public string $buttonLink;
    public string $buttonText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        // TODO: get level to start based on recent activity;
        $this->level = Level::all()->first();
        // If no levels started or completed last level of challenge:
        $this->buttonText = __('Explore challenges');
        $this->buttonLink = route('student.challenges');
        // If last level started but not completed:
        $this->buttonText = __('Continue current level');
        $this->buttonLink = route('student.challenges');
        // If last level completed:
        $this->buttonText = __('Start next level');
        $this->buttonLink = route('student.challenges');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-status');
    }
}
