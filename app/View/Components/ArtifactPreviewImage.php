<?php

namespace App\View\Components;

use App\Models\Artifact;
use Illuminate\View\Component;

class ArtifactPreviewImage extends Component
{
    public Artifact $artifact;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Artifact $artifact)
    {
        $this->artifact = $artifact;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.artifact-preview-image');
    }
}
