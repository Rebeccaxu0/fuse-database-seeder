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
            $studios = Studio::with(
                [
                    'package',
                    'school',
                    'school.package',
                    'school.district',
                    'school.district.package',
                ])
                ->whereHas('school', function (Builder $query) {
                    $query->where('id', $this->schoolId);
                })
                ->orderBy('name')
                ->get();
        }
        else {
            $studios = Studio::orderBy('name')->paginate(15);
        }
        foreach ($studios as $studio) {
            if (! $studio->package) {
                if ($studio->school->package) {
                    $studio->packageText = "{$studio->school->package->name} (Inherited)";
                }
                else if ($studio->school->district->package) {
                    $studio->packageText = "{$studio->school->district->package->name} (Inherited)";
                }
                else {
                    'NO PACKAGE!';
                }
            }
            else
            {
                $studio->packageText = $studio->package->name;
            }
        }
        return view('livewire.admin.studios-page', ['studios' => $studios]);
    }
}
