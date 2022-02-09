<?php

namespace App\Http\Livewire;

use App\Models\Studio;
use App\Models\User;
use Livewire\Component;

class UserEditModal extends Component
{
    public $showEditModal = false;
    public Studio $studio;
    public User $user;

    public function submit() {
        $this->student->name = $this->name;
        $this->student->save();

        $this->emitUp('updateStudents');
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.user-edit-modal');
    }

    protected function rules() {
        return [
            'user.full_name' => 'required|string',
            'user.name' => 'required|string|unique:users,name',
            'user.email' => 'email|unique:users,email',
            'user.birthday' => 'required|date',
            'user.gender' => 'nullable',
            'user.ethnicity' => 'nullable',
            'password' => ($this->studio->require_email) ? 'required|' : '' . 'string|confirmed',
        ];
    }
}
