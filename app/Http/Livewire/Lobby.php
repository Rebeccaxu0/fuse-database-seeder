<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Lobby extends Component
{
    public string $email = '';
    public string $studioCode = '';
    public bool $validStudioCode = false;
    public ?Studio $studio = null;
    public ?User $user = null;
    public string $studioName = '';
    public string $school = '';

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

    // This is only for new SSO users or Alum users. Guest registration is
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
        return redirect(route('student.dashboard'));
    }

    public function render()
    {
        return view('livewire.lobby');
    }

    protected function rules()
    {
        $rules = [
            'studioCode' => 'required|exists:App\Models\Studio,join_code',
            'email' => [
                Rule::when($this->studio && $this->studio->require_email, ['required', 'email']),
            ],
        ];

        return $rules;
    }
}
