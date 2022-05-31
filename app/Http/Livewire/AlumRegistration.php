<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studio;
use App\Models\User;
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

    public function codecheck() {
        $user = Auth::user();
        $this->validate();
        $this->studio = Studio::where('join_code', $this->studioCode)->first();
        $this->studioName = $this->studio->name;
        $this->school = $this->studio->school->name;
        if (! $this->studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        }
        else {
            // If studio requires email and alumni user has no email attached to their account.
            if ($this->studio->require_email && (! $user->email)) {
                $this->showEmail = true;
            }
            $this->showJoin = true;
            //show school and studio
        }
    }

    public function join(){
        $user = Auth::user();
        $user->studios()->attach($this->studio->id);
        $user->activeStudio()->associate($this->studio);
        $user->active_studio = $this->studio->id;
        $user->save();
        Cache::forget("u{$user->id}_studios");
        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.alum-registration');
    }
}
