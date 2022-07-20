<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class LobbyComponent extends Component
{
    public string $studioCode = '';
    public string $email = '';
    public bool $showEmail = false;
    public bool $validCode = false;
    public string $joinRedirectTarget = RouteServiceProvider::HOME;
    public $studio = null;
    public string $studioName = '';
    public string $school = '';
    public string $title = '';
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        if ($this->user->starts->count()) {
            $this->title = __('Welcome Back!');
        }
        else {
            $this->title = __('Welcome to FUSE!');
        }
    }

    public function updatedStudioCode($value)
    {
        $this->validateOnly('studioCode');

        $studioCode = Str::of($value)->trim()->replaceMatches('/[ ]\+/', ' ')->lower();
        $this->studio = Studio::where('join_code', $studioCode)->first();
        $this->studioName = $this->studio->name;
        $this->school = $this->studio->school->name;
        // If studio requires email and alumni user has no email attached to their account.
        if ($this->studio->require_email && (! Auth::user()->email)) {
            $this->showEmail = true;
        }
        $this->validCode = true;
    }

    public function submit()
    {
        $this->validate();

        if ($this->email) {
            $this->user->email = $this->email;
            $this->user->save();
        }
        $this->user->studios()->syncWithoutDetaching($this->studio->id);
        $this->user->activeStudio()->associate($this->studio);
        Log::channel('fuse_activity_log')
            ->info('studio_add', ['user' => $this->user, 'studio' => $this->studio]);
        Cache::forget("u{$this->user->id}_studios");
        return redirect($this->joinRedirectTarget);
    }

    protected function rules()
    {
        $rules = ['studioCode' => 'required|exists:App\Models\Studio,join_code'];
        if ($this->studio && $this->studio->require_email) {
            $rules['email'] = 'required|email';
        }

        return $rules;
    }
}
