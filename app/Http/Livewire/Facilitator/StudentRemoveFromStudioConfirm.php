<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class StudentRemoveFromStudioConfirm extends Component
{
    public bool $showDeleteModal = false;
    public Studio $studio;
    public User $student;

    public function mount(Studio $studio)
    {
        $this->studio = $studio;
    }

    public function submit() {
        $this->student->studios()->detach($this->studio->id);
        if ($this->student->activeStudio->is($this->studio)) {
            $this->student->activeStudio()->dissociate();
            $this->student->save();
        }
        Log::channel('fuse_activity_log')
            ->info('studio_remove', ['user' => $this->student, 'studio' => $this->studio]);
        Cache::forget("u{$this->student->id}_studios");

        $this->emitUp('updateStudents');
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.facilitator.student-remove-from-studio-confirm');
    }
}

