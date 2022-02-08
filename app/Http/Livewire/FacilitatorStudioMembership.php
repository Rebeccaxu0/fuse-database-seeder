<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacilitatorStudioMembership extends Component
{
    public $students;
    public Studio $studio;

    protected $listeners = ['updateStudents', 'updateFacilitators'];

    public function updateStudents() {
        $this->students = $this->studio
            ->students()
            ->orderBy('name')
            ->get();
    }

    public function mount() {
        $this->studio = Studio::find(Auth::user()->active_studio);
        $this->students = $this->studio
            ->students()
            ->orderBy('name')
            ->get();
        $this->facilitators = $this->studio
            ->facilitators()
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.facilitator-studio-membership')
            ->layout(\App\View\Components\AppLayout::class, ['title' => __('People'), 'header' => __('People')]);
    }
}
