<?php

namespace App\View\Components;

use App\Models\Studio;
use App\Models\User;
use Illuminate\View\Component;

class StudioNotes extends Component
{
    public Studio $studio;
    public User $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->studio = $user->activeStudio;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.studio-notes');
    }
}
