<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class StudiosPage extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public bool $showAddFacModalFlag = false;
    public bool $showFSPickerModalFlag = false;
    public ?District $activeDistrict = null;
    public ?School $activeSchool = null;
    public ?Collection $districts = null;
    public ?Collection $schools = null;
    public Collection $facilitators;
    public Collection $studios;
    public string $activeDistrictName = '<none>';
    public string $activeSchoolName = '<none>';
    public ?int $activeDistrictId = null;
    public ?int $activeSchoolId = null;

    protected $queryString = [
        'activeDistrictId' => ['as' => 'district'],
        'activeSchoolId' => ['except' => null, 'as' => 'school'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    protected $listeners = [
        'schoolSelected' => 'setSchool',
        'userSelected' => 'addFacilitator',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->facilitators = $this->studios = new Collection;

        $district = null;
        if ($this->activeDistrictId) {
            $district = District::find($this->activeDistrictId);
        }
        else if ($user->activeStudio->school && $user->activeStudio->school->district) {
            $district = $user->activeStudio->school->district;
        }
        $this->setDistrict($district);

        if ($this->activeSchoolId) {
            if ($this->schools->contains($this->activeSchoolId)) {
                $this->setSchool(School::find($this->activeSchoolId));
            }
        }
        else {
            $this->setSchool($user->activeStudio->school);
        }

        if ($user->isAdmin()) {
            $this->districts = District::all();
        }

        if ($this->activeSchool) {
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

    public function setDistrict(?District $district)
    {
        $this->activeDistrict = $district;
        $this->activeDistrictId = $district->id;
        $this->activeDistrictName = $district->name;
        $this->schools = $district->schools;
    }

    public function setSchool(?School $school)
    {
        if (is_null($school)) {
            $this->activeSchool = null;
            $this->activeSchoolId = null;
            $this->activeSchoolName = __('no schools in district.');
            $this->facilitators = $this->studios = new Collection;
        }
        else {
            if (Auth::user()->isAdmin() && $school->district) {
                $this->setDistrict($school->district);
            }
            if ($this->schools->contains($school->id)) {
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
                    ]
                )
                    ->whereHas('school', function (Builder $query) {
                        $query->where('id', $this->activeSchoolId);
                    })
                    ->orderBy('name')
                    ->get();
                $this->facilitators = $this->activeSchool->users;
            }
        }
        if (Auth::user()->isAdmin()) {
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

    public function addFacilitator(int $facilitatorId)
    {
        $this->activeSchool->addFacilitators([$facilitatorId]);
        $this->activeSchool->refresh();
        $this->facilitators = $this->activeSchool->users;
    }

    public function removeFacilitator(int $facilitatorId)
    {
        $this->activeSchool->removeFacilitators([$facilitatorId]);
        $this->activeSchool->refresh();
        $this->facilitators = $this->activeSchool->users;
    }

    public function render()
    {
        // $studios = Studio::orderBy('name')->paginate(15);
        return view('livewire.admin.studios-page');
    }
}
