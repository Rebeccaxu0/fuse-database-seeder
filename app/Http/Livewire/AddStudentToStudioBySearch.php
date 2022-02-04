<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddStudentToStudioBySearch extends Component
{
    public $search = '';
    public $students = [];

    public function add(User $student)
    {
        Auth::user()->activeStudio->students()->attach($student);
        $this->search = '';
        $this->emitUp('updateStudents');
    }

    public function render()
    {
        $studio_members_q = User::select('id')
            ->whereRelation('roles', 'id', Role::STUDENT_ID)
            ->whereRelation('studios', 'id', Auth::user()->activeStudio->id);

        $users_q = User::with(['activeStudio', 'activeStudio.school'])
            ->whereRelation('roles', 'id', Role::STUDENT_ID)
            ->whereNotIn('id', $studio_members_q)
            ->where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('full_name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->limit(10);

        $this->u_query = $users_q->toSql();
        $this->students = $users_q->get();
        return view('livewire.add-student-to-studio-by-search');
    }
}
