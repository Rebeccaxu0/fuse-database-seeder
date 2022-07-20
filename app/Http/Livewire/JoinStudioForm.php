<?php

namespace App\Http\Livewire;

class JoinStudioForm extends LobbyComponent
{
    public bool $showModalFlag = false;
    public string $joinText = '';

    public function mount()
    {
        parent::mount();

        $this->joinRedirectTarget = request()->header('Referer');
    }

    public function updatedShowModalFlag($value) {
        if (! $value) {
            $this->studioCode = '';
            $this->resetValidation();
        }
    }

    public function render()
    {
        return view('livewire.join-studio-form');
    }
}

