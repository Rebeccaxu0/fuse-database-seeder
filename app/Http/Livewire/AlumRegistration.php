<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studio;
use Illuminate\Support\Facades\Auth;

class AlumRegistration extends Component
{
    public string $studioCode = '';

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function codecheck() {
        $this->validate();
        $studio = Studio::where('join_code', $this->studioCode)->first();
        if (! $this->studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        }
    }

    public function render()
    {
        return view('livewire.alumregistration');
    }
}
