<?php

namespace App\View\Components;

use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class StudioSwitcher extends Component
{
    public ?Studio $activeStudio = null;
    public $otherStudios = null;
    public bool $multipleSchools = false;

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
            $this->multipleSchools =
                $this->otherStudios->pluck('school_id')->unique()->count() > 1;
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
