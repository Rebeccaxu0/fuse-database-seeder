<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;

class Registration extends Component
{
    public string $studioCode = '';
    public bool $showEmail = false;
    public bool $showManualRegistrationForm = false;
    public $studio = null;
    public string $studioName = '';
    public string $school = '';
    
    protected $rules = [
        'studioCode' => 'required',
    ];

    public function codecheck() {
        $user = Auth::user();
        $this->validate();
        $this->studio = Studio::where('join_code', $this->studioCode)->first();
        if (!$this->studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        } else {
            $this->studioName = $this->studio->name;
            $this->school = $this->studio->school->name;
            if ($this->studio->require_email) {
                $this->showEmail = true;
            }
            $this->showManualRegistrationForm = true;
        }
    }

    public function render()
    {
        return view('livewire.registration');
    }
}
