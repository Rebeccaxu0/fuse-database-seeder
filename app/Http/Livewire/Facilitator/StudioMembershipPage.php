<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use App\View\Components\AppLayout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioMembershipPage extends Component
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
        $this->studio = Auth::user()->activeStudio;
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
        return view('livewire.facilitator.studio-membership-page')
            ->layout(AppLayout::class, ['title' => __('People'), 'header' => __('People')]);
    }
}
