<?php

namespace App\View\Components;

class ArtifactModalContent extends ArtifactComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.artifact-modal-content');
    }
}
