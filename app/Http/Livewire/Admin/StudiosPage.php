<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class StudiosPage extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public bool $showAddFacModalFlag = false;
    public bool $showFSPickerModalFlag = false;
    public ?District $activeDistrict;
    public ?School $activeSchool;
    public ?Collection $districts = null;
    public ?Collection $schools;
    public ?Collection $studios;
    public string $activeDistrictName = '<none>';
    public string $activeSchoolName = '<none>';
    public ?int $activeDistrictId = null;
    public ?int $activeSchoolId = null;

    protected $queryString = [
        'activeDistrictId' => ['as' => 'district'],
        'activeSchoolId' => ['except' => null, 'as' => 'school'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    protected $listeners = ['schoolSelected' => 'setSchool'];

    public function mount()
    {
        $user = auth()->user();

        if (! $this->activeSchoolId) {
            $this->activeSchoolId = $user->activeStudio->school->id;
        }
        $this->setSchool(School::find($this->activeSchoolId));

        if ($user->isAdmin()) {
            $this->districts = District::all();
            if ($this->activeDistrictId) {
                $this->setDistrict(District::find($this->activeDistrictId), false);
            }
            else {
                $this->setDistrict(District::first(), false);
            }
        }
        elseif ($user->isSuperFacilitator()) {
            $this->activeDistrict = $this->activeSchool->district;
            $this->activeDistrictId = $this->activeDistrict->id;
            $this->activeDistrictName = $this->activeDistrict->name;
            $this->schools = $user->defactoSchools();
        }

        if ($this->activeSchoolId) {
            $this->authorize('view', $this->activeSchool);
        }
        else {
            $this->authorize('viewAny', School::class);
        }
    }

    public function updatedActiveDistrictId($activeDistrictId)
    {
        $this->setDistrict(District::find($activeDistrictId));
        $this->setSchool($this->activeDistrict->schools->first());
    }

    public function updatedActiveSchoolId($activeSchoolId)
    {
        $this->setSchool(School::find($activeSchoolId));
    }

    public function setDistrict(District $district)
    {
        $this->activeDistrict = $district;
        $this->activeDistrictId = $district->id;
        $this->schools = $district->schools;
        if (! $this->schools->empty()) {
            $this->activeSchool = $this->activeDistrict->schools->first();
            $this->activeSchoolName = $this->activeSchool->name;
        }
        else {
            $this->activeSchool = null;
            $this->activeSchoolName = 'no schools in this district';
        }
    }

    public function setSchool(?School $school)
    {
        if (is_null($school)) {
            $this->activeSchool = null;
            $this->activeSchoolId = null;
            $this->activeSchoolName = __('no schools in district.');
            $this->studios = null;
        } else {
            $this->setDistrict($school->district);
            $this->activeSchool = $school;
            $this->activeSchoolId = $school->id;
            $this->activeSchoolName = $school->name;
            $this->studios = Studio::with(
                [
                    'package',
                    'school',
                    'school.package',
                    'school.district',
                    'school.district.package',
                ])
                ->whereHas('school', function (Builder $query) {
                    $query->where('id', $this->activeSchoolId);
                })
                ->orderBy('name')
                ->get();
            $this->facilitators = $this->activeSchool->users;
        }
        if (auth()->user()->isAdmin()) {
            foreach ($this->studios as $studio) {
                if (! $studio->package) {
                    if ($studio->school && $studio->school->package) {
                        $studio->packageText = "{$studio->school->package->name} (Inherited)";
                    }
                    else if ($studio->school && $studio->school->district && $studio->school->district->package) {
                        $studio->packageText = "{$studio->school->district->package->name} (Inherited)";
                    }
                    else {
                        $studio->packageText = 'NO PACKAGE!';
                    }
                }
                else
                {
                    $studio->packageText = $studio->package->name;
                }
            }
        }
    }

    public function removeFacilitator(int $facilitatorId)
    {
        $this->activeSchool->removeFacilitators([$facilitatorId]);
        $this->setSchool($this->activeSchool);
    }

    public function render()
    {
        // $studios = Studio::orderBy('name')->paginate(15);
        return view('livewire.admin.studios-page');
    }
}
