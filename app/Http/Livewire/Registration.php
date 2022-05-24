<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studio;
use Illuminate\Support\Facades\Auth;

class Registration extends Component
{
    public string $studioCode = '';
    public bool $showReg = false;
    public bool $showEmail = false;
    public $studio = null;

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function codecheck() {
        $this->validate();
        $this->studio = Studio::where('join_code', $this->studioCode)->first();
        if (! $this->studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        }
        else {
            $this->showReg = true;
            if ($this->studio->require_email) {
                $this->showEmail = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
