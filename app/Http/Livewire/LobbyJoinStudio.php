<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class LobbyJoinStudio extends Component
{
    public string $studioCode = '';

    protected $rules = [
        'studioCode' => 'required',
    ];

    public function submit() {
        $this->validate();
        $studio = Studio::where('join_code', $this->studioCode)->first();
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
        return view('livewire.lobby-join-studio');
    }
}
