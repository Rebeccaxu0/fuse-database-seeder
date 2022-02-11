<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use Livewire\Component;

class StudioDashboardMessage extends Component
{
    public Studio $studio;

    protected $rules = [
        'studio.dashboard_message' => 'optional|string|max:500',
    ];

    public function updatedStudio($name, $key)
    {
        $this->studio->save();
    }

    public function render()
    {
        return view('livewire.facilitator.studio-dashboard-message');
    }
}
