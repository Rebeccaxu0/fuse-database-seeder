<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class StudiosPage extends Component
{
    use WithPagination;

    public ?School $school;
    public ?int $schoolId = null;

    protected $queryString = [
        'schoolId' => ['except' => null, 'as' => 'school'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    protected $listeners = ['schoolSelected' => 'setSchool'];

    public function mount()
    {
        if ($this->schoolId) {
            $this->setSchool($this->schoolId);
        }
    }

    public function setSchool(int $school_id)
    {
        $this->schoolId = $school_id;
        $this->school = School::find($school_id);
    }

    public function render()
    {
        if ($this->schoolId) {
            $studios = Studio::whereHas('school', function (Builder $query) {
                $query->where('id', $this->schoolId);
            });
        }
        else {
            $studios = Studio::orderBy('name');
        }
        $studios = $studios
                       ->paginate(15);
        return view('livewire.admin.studios-page', ['studios' => $studios]);
    }
}
