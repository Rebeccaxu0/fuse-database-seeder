<?php

namespace App\View\Components;

use App\Models\Studio;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StudioSwitcher extends Component
{
    public ?Studio $activeStudio = null;
    public Collection $otherStudios;
    public bool $multipleSchools = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = auth()->user();
        $this->otherStudios = new Collection;
        if ($user->deFactoStudios()->count() > 0) {
            $this->activeStudio = $user->activeStudio;
            $this->otherStudios = $user->deFactoStudios()
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
