<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacilitatorStudioMembership extends Component
{
    public $students;

    protected $listeners = ['updateStudents', 'updateFacilitators'];

    public function updateStudents() {
        $this->students = Studio::find(Auth::user()->active_studio)
            ->students()
            ->orderBy('name')
            ->get();
    }

    public function mount() {
        $this->students = Studio::find(Auth::user()->active_studio)
            ->students()
            ->orderBy('name')
            ->get();
        $this->facilitators = Studio::find(Auth::user()->active_studio)
            ->facilitators()
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.facilitator-studio-membership');
    }
}
