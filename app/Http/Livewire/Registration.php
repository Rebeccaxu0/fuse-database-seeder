<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Illuminate\Support\Str;
use Livewire\Component;

class Registration extends Component
{
    public string $studioCode = '';
    public bool $validStudioCode = false;
    public bool $showEmailForm = false;
    public bool $showManualRegistrationForm = false;
    public ?Studio $studio = null;
    public string $studioName = '';
    public string $school = '';

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function mount()
    {
        $this->studioCode = old('studioCode', '');
        if ($this->studioCode) {
            $this->updatedStudioCode();
        }
    }

    public function updatedStudioCode()
    {
        $studioCode = Str::of($this->studioCode)->replaceMatches('/[ ]++/', ' ')->trim()->lower();
        $this->studio = Studio::where('join_code', $studioCode)->first();
        if (! $this->studio) {
            $this->validStudioCode = false;
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
            $this->showManualRegistrationForm = false;
            $this->showEmailForm = false;
            $this->showJoin = false;
        }
        else {
            $this->validStudioCode = true;
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
