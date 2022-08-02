<?php

namespace App\Http\Livewire\Facilitator;

use App\Models\Studio;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RemoveAllStudentsFromStudio extends Component
{
    public bool $showRemoveModal = false;
    public Studio $studio;

    public function mount(Studio $studio)
    {
        $this->studio = $studio;
        $this->studio_display = $studio->name;
        if ($studio->school) {
            $this->studio_display = $studio->school->name . ' - ' . $studio->name;
        }
    }

    public function submit() {
        foreach ($this->studio->students as $student) {
            $student->studios()->detach($this->studio->id);
            Log::channel('fuse_activity_log')
                ->info('studio_remove', ['user' => $student, 'studio' => $this->studio]);
            Cache::forget("u{$student->id}_studios");
        }
        $this->emitUp('updateStudents');
        $this->showRemoveModal = false;
    }

    public function render()
    {
        return view('livewire.facilitator.remove-all-students-from-studio');
    }
}
