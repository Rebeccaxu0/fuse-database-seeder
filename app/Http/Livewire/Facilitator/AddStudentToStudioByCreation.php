<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\EthnicityOptions;
use App\Models\GenderOptions;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit() {
        $this->validate();

        $this->student->password = Hash::make($this->password);
        $this->student->active_studio = $this->studio->id;
        $this->student->save();
        $this->student->studios()->attach($this->studio->id);
        Log::channel('fuse_activity_log')
            ->info('studio_add', ['user' => $this->student, 'studio' => $this->studio]);

        $this->initializeStudent();
        $this->reset(['password', 'password_confirmation', 'permission']);

        $this->emitUp('updateStudents');
        $this->showCreateStudentFormModal = false;
    }

    public function render()
    {
        return view('livewire.facilitator.add-student-to-studio-by-creation');
    }

    protected function rules() {
        return [
            'student.full_name' => 'required|string',
            'student.name' => 'required|string|unique:users,name',
            // There's an argument that student.email collection should be
            // required or not based on studio settings. But, if a facilitator
            // doesn't have a student's email, they would need to temporarily
            // disable email in the studio to create. If we don't enforce, then
            // the student will be asked to add email on login.
            'student.email' => 'nullable|email|unique:users,email',
            'password' => ($this->studio->require_email) ? 'required|' : '' . 'string|confirmed',
        ];
    }

    private function initializeStudent() {
        $this->student = new User;
        $this->student->gender = 'U';
        $this->student->ethnicity = 'rather_not_say';
    }
}

