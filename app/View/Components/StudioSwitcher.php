<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class StudioSwitcher extends Component
{
    public $activeStudio;
    public $otherStudios;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->activeStudio = Auth::user()->currentStudio;
        $this->otherStudios = Auth::user()
             ->deFactoStudios()->except([$this->activeStudio->id]);
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
