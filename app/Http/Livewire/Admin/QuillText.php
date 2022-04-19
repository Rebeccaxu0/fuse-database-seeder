<?php

namespace App\Http\Livewire\Admin;
use App\Models\ChallengeVersion;
use Livewire\Component;

class QuillText extends Component
{
    public $label;
    public $sublabel;
    public ChallengeVersion $challengeversion;

    protected $rules = [
        'challengeversion.facilitator_notes' => 'optional|string|max:1000',
    ];

    public function updatedChallengeVersion($name, $key)
    {
        $this->challengeversion->save();
    }

    public function render()
    {
        return view('livewire.admin.quill-text');
    }
}
