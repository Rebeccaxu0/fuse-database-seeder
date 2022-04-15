<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ArtifactTeammates extends Component
{
    public $studioMembers;
    public $teammates = [];
    public $teamNames = [];

    public function mount(User $user)
    {
        $this->studioMembers = $user->activeStudio->students->except($user->id);
        for ($i = 0; $i < count($this->studioMembers); $i++) {
            if (old("teammates.{$i}")) {
                $this->teammates[] = old("teammates.{$i}");
            }
        }
        $this->updatedTeammates($this->teammates);

    }

    public function updatedTeammates($value)
    {
        $this->teamNames = [];
        foreach ($this->teammates as $k => $uid) {
            $this->teamNames[] = User::find($uid)->full_name;
        }
    }

    public function render()
    {
        return view('livewire.artifact-teammates');
    }
}
