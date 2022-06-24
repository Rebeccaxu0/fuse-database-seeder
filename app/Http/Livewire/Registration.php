<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Livewire\Component;

class Registration extends Component
{
    public string $studioCode = '';
    public bool $showEmailForm = false;
    public bool $showManualRegistrationForm = false;
    public $studio = null;
    public string $studioName = '';
    public string $school = '';

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function codecheck() {
        $this->studio = Studio::where('join_code', $this->studioCode)->first();
        if (! $this->studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
            $this->showManualRegistrationForm = false;
            $this->showEmailForm = false;
            $this->showJoin = false;
        }
        else {
            $this->resetErrorBag();
            $this->studioName = $this->studio->name;
            $this->school = $this->studio->school->name;
            if ($this->studio->require_email) {
                $this->showEmailForm = true;
            }
            else {
                $this->showManualRegistrationForm = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
