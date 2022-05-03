<?php

namespace App\Http\Livewire\Admin;
use App\Models\ChallengeVersion;
use App\Models\Level;
use Livewire\Component;

class QuillText extends Component
{
    public $name; //request parameter ex. challenge_desc
    public $label; //label for text box
    public $sublabel; //sublabel
    public $content; //name for content of quill editor box
    public $old; //previous contents

    public function render()
    {
        return view('livewire.admin.quill-text');
    }
}
