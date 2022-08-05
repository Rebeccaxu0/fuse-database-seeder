<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use App\View\Components\AppLayout;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudioMembershipPage extends Component
{
    use AuthorizesRequests;

    public $students;
    public Studio $studio;

    protected $listeners = ['updateStudents', 'updateFacilitators'];

    public function updateFacilitators()
    {
        $this->facilitators = $this->studio
            ->facilitators()
            ->orderBy('full_name')
            ->get();
    }

    public function updateStudents()
    {
        $this->students = $this->studio
            ->students()
            ->orderBy('full_name')
            ->get();
    }

    public function mount()
    {
        $this->authorize('viewAny', User::class);
        $this->studio = Auth::user()->activeStudio;
        $this->updateStudents();
        $this->updateFacilitators();
    }

    public function render()
    {
        return view('livewire.facilitator.studio-membership-page')
            ->layout(AppLayout::class, ['title' => __('People'), 'header' => __('People')]);
    }
}

