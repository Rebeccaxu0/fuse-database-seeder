<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\NoExistingMembers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class LobbyComponent extends Component
{
    public string $email = '';
    public string $studioCode = '';
    public bool $validStudioCode = false;
    public string $joinRedirectTarget = 'dashboard';
    public string $studioName = '';
    public string $school = '';
    public string $title = '';
    public ?Studio $studio = null;
    public ?User $user;

    public function mount()
    {
        $this->title = __('Welcome to FUSE!');
        if (auth()->user()) {
            $this->user = auth()->user();
            if ($this->user->starts->count()) {
                $this->title = __('Welcome Back!');
            }
        }
        $this->studioCode = old('studioCode', '');
        if ($this->studioCode) {
            $this->updatedStudioCode($this->studioCode);
        }
    }

    public function updatedStudioCode($value)
    {
        $this->studio = null;
        $this->validStudioCode = false;
        $this->validateOnly('studioCode');

        $this->validStudioCode = true;
        $studioCode = Str::of($value)->trim()->replaceMatches('/[ ]\+/', ' ')->lower();
        $this->studio = Studio::where('join_code', $studioCode)->first();
        $this->studioName = $this->studio->name;
        $this->school = $this->studio->school->name;
    }

    // This is only for existing users - adding an additional studio or joining
    // a first studio as a new SSO user or an Alum user. Guest registration is
    // submitted to default registration route.
    // See /App/Actions/Fortify/CreateNewUser
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
        $rules = [
            'studioCode' => [
                'bail',
                'required',
                'exists:App\Models\Studio,join_code',
                new NoExistingMembers,
            ],
            'email' => [
                Rule::when($this->studio && $this->studio->require_email, ['required', 'email']),
            ],
        ];

        return $rules;
    }
}
