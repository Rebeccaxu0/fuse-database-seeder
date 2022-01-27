<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class StudioSwitcher extends Component
{
    public $activeStudio = null;
    public $otherStudios = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::user()->deFactoStudios()->count() > 0) {
            $this->activeStudio = Auth::user()->activeStudio;
            $this->otherStudios =
                Auth::user()
                    ->deFactoStudios()
                    ->except([$this->activeStudio->id]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.studio-switcher');
    }
}
