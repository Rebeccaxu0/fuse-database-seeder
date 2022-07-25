<?php

namespace App\View\Components;

use App\Models\Artifact;
// use App\Models\ChallengeVersion;
// use Filestack\Filelink;
use Illuminate\View\Component;

class ArtifactImage extends Component
{
    public Artifact $artifact;
    public bool $needsScrim = true;
    public string $aggregate_type = '';
    public ?string $imageUrl = null;
    public string $iconUrl = '';
    public bool $preview = true;
    // Debug
    public string $filestackHandle = 'none';
    public string $mime = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Artifact $artifact, bool $preview = true)
    {
        $useChallengePreviewImage = true;
        $this->preview = $preview;
        $this->artifact = $artifact;
        $this->aggregate_type = $artifact->getAggregateMimeType();
        if ($preview || ($this->aggregate_type != 'image' && $this->aggregate_type != 'video')) {
            $this->imageUrl = $artifact->getPreviewUrl();
        }
        else {
            $this->imageUrl = $artifact->getRawFileUrl();
        }

        // What type of artifact? URL or file? What kind of file?
        // Set icon and scrim.
        switch ($this->aggregate_type) {
            case 'url':
                $this->iconUrl = "/img/link.svg";
                break;

            case 'audio':
                $this->iconUrl = "/img/audio.svg";
                break;

            case 'image':
                $this->needsScrim = false;
                break;

            case 'video':
                $this->iconUrl = "/img/video.svg";
                $this->needsScrim = false;
                break;

            default:
                $this->iconUrl = "/img/misc.svg";
        }

        if ($artifact->filestack_handle) {
            $this->filestackHandle = $artifact->filestack_handle;
            // dd($filelink);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.artifact-image');
    }
}
