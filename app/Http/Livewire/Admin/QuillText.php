<?php

namespace App\Http\Livewire\Admin;
use App\Models\ChallengeVersion;
use Livewire\Component;

class QuillText extends Component
{
    public $name; //request parameter ex. challenge_desc
    public $label; //label for text box

    public function render()
    {
        return view('livewire.admin.quill-text');
    }
}
