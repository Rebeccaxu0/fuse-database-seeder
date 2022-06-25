<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;

class JoinStudioForm extends Component
{
    public bool $showModalFlag = false;
    public string $joinText = '';
    public string $studioCode = '';

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function mount()
    {
        if (! Auth::user()->deFactoStudios()->count()) {
            $this->joinText = __('Join a Studio');
        }
    }

    public function submit()
    {
        $this->validate();
        $studioCode = Str::of($this->studioCode)->trim()->replaceMatches('/[ ]\+/', ' ')->lower();
        $studio = Studio::where('join_code', $studioCode)->first();
        if (! $studio) {
            $this->addError('studioCode', __('Sorry, that code does not match any studios'));
        }
        else if (Auth::user()->deFactoStudios()->contains($studio)) {
            $this->addError('studioCode', __('You are already a member of that studio.'));
        }
        else {
            $user = Auth::user();
            $user->studios()->attach($studio->id);
            $user->activeStudio()->associate($studio);
            Cache::forget("u{$user->id}_studios");

            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.join-studio-form');
    }
}

