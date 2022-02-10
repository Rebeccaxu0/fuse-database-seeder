<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Toggle;
use App\Models\Studio;

class StudioBoolToggle extends Toggle
{
    public Studio $studio;
    public string $property = '';

    public function mount() {
        $this->is_active = (bool) $this->studio->{$this->property};
    }

    public function toggle()
    {
        parent::toggle();

        $this->studio->{$this->property} = $this->is_active;
        $this->studio->save();
    }

}

