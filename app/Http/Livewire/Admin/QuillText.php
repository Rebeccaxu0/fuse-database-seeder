<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class QuillText extends Component
{
    public $label;

    public function render()
    {
        return view('livewire.admin.quill-text');
    }
}
