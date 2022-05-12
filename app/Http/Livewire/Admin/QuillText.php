<?php

namespace App\Http\Livewire\Admin;

use App\Models\ChallengeVersion;
use App\Models\Level;
use Livewire\Component;

class QuillText extends Component
{
    // Name and request parameter.
    public $name; 
    public $label; 
    public $sublabel; 
    // Variable name for content of quill editor box.
    public $content; 
    public $old;

    public function render()
    {
        return view('livewire.admin.quill-text');
    }
}
