<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;

class AlumRegistration extends Component
{
    public string $studioCode = '';
    public bool $showEmail = false;
    public bool $showJoin = false;
    public $studio = null;
    public string $studioName = '';
    public string $school = '';

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function codecheck()
    {
        $this->validate();
        $this->studio = Studio::where('join_code', $this->studioCode)->first();
        if (!$this->studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        } else {
            $this->studioName = $this->studio->name;
            $this->school = $this->studio->school->name;
            // If studio requires email and alumni user has no email attached to their account.
            if ($this->studio->require_email && (! Auth::user()->email)) {
                $this->showEmail = true;
            }
            $this->showJoin = true;
        }
    }

    public function join()
    {
        $user = Auth::user();
        $user->studios()->attach($this->studio->id);
        $user->activeStudio()->associate($this->studio);
        Cache::forget("u{$user->id}_studios");
        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.alum-registration');
    }
}
