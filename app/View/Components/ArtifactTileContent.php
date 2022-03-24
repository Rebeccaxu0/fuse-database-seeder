<?php

namespace App\View\Components;

class ArtifactTileContent extends ArtifactComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.artifact-tile-content');
    }
}
