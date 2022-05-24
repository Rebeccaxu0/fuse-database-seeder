<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studio;
use Illuminate\Support\Facades\Auth;

class CustomRegistration extends Component
{
    public string $studioCode = '';
    public bool $showReg = false;
    public bool $showEmail = false;

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function codecheck() {
        $this->validate();
        $studio = Studio::where('join_code', $this->studioCode)->first();
        if (! $studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        }
        // else if (Auth::user()->deFactoStudios()->contains($studio)) {
        //     $this->addError('studioCode', __('You are already a member of that studio.'));
        // }
        else {
            $this->showReg = true;
            if ($studio->require_email) {
                $this->showEmail = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.custom-registration');
    }
}
