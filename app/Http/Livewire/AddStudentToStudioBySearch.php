<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddStudentToStudioBySearch extends Component
{
    public $search = '';
    public $student = [];

    public function add(User $student)
    {
        $studio = Auth::user()->activeStudio;
        $this->emitUp('updateStudents');
    }

    public function render()
    {
        $users_q = User::with(['activeStudio', 'activeStudio.school'])
            ->whereRelation('roles', 'id', Role::STUDENT_ID)
            ->where(function ($query) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('full_name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->limit(10);

        $this->students = $users_q->get();
        return view('livewire.add-student-to-studio-by-search');
    }
}
