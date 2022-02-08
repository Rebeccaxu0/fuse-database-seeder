<?php

namespace App\Http\Livewire;

use App\Models\EthnicityOptions;
use App\Models\GenderOptions;
use App\Models\Role;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddStudentToStudioByCreation extends Component
{
    public bool $showCreateStudentFormModal = false;
    public Studio $studio;
    public User $student;
    public string $password = '';
    public string $password_confirmation = '';
    public bool $permission = false;

    public array $genderOptions = [];
    public array $ethnicityOptions = [];

    protected function rules() {
        return [
            'student.full_name' => 'required|string',
            'student.name' => 'required|string|unique:users,name',
            'student.email' => 'email|unique:users,email',
            'student.birthday' => 'required|date',
            'student.gender' => 'nullable',
            'student.ethnicity' => 'nullable',
            'password' => ($this->studio->require_email) ? 'required|' : '' . 'string|confirmed',
        ];
    }

    public function mount(Studio $studio)
    {
        $this->studio = $studio;
        $this->initializeStudent();

        $this->genderOptions = GenderOptions::full();
        if ($this->studio->restrict_gender_options) {
            $this->genderOptions = GenderOptions::restricted();
        }
        $this->ethnicityOptions = EthnicityOptions::full();
    }

    private function initializeStudent() {
        $this->student = new User;
        $this->student->gender = 'U';
        $this->student->ethnicity = 'rather_not_say';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit() {
        $this->validate();

        $this->student->password = Hash::make($this->password);
        $this->student->active_studio = $this->studio->id;
        $this->student->save();
        $this->student->roles()->attach(ROLE::STUDENT_ID);
        $this->student->studios()->attach($this->studio->id);

        $this->initializeStudent();
        $this->reset(['password', 'password_confirmation', 'permission']);

        $this->emitUp('updateStudents');
        $this->showCreateStudentFormModal = false;
    }

    public function render()
    {
        return view('livewire.add-student-to-studio-by-creation');
    }
  }

