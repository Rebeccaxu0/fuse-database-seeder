<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserEditModal extends Component
{
    public bool $showEditModal = false;
    public string $password = '';
    public string $password_confirmation = '';
    public Studio $studio;
    public User $user;

    public function submit() {
        $this->validate();
        if ($this->password) {
            $this->user->forceFill([
                'password' => Hash::make($this->password),
            ]);
        }
        $this->user->save();
        $this->password = '';
        $this->password_confirmation = '';

        $this->emitUp('updateStudents');
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.facilitator.user-edit-modal');
    }

    protected function rules() {
        return [
            'user.name' => [
                'required',
                'string',
                Rule::unique('users', 'name')->ignore($this->user->id),
            ],
            'user.full_name' => 'required|string',
            'user.email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'password' =>  'string|min:8|confirmed',
        ];
    }
}
