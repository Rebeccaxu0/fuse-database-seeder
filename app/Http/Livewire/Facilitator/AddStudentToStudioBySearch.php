<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddStudentToStudioBySearch extends Component
{
    public Studio $studio;
    public $search = '';
    public $students = [];

    public function add(User $student)
    {
        $this->studio->students()->attach($student);
        $this->search = '';
        $this->emitUp('updateStudents');
    }

    public function mount(Studio $studio)
    {
        $this->studio = $studio;
    }

    public function render()
    {
        $studio_members_q = User::select('id')
            ->doesntHave('roles')
            ->whereRelation('studios', 'id', Auth::user()->activeStudio->id);

        $users_q = User::with(['activeStudio', 'activeStudio.school'])
            ->doesntHave('roles')
            ->whereNotIn('id', $studio_members_q)
            ->where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('full_name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->limit(10);

        $this->u_query = $users_q->toSql();
        $this->students = $users_q->get();
        return view('livewire.facilitator.add-student-to-studio-by-search');
    }
}
