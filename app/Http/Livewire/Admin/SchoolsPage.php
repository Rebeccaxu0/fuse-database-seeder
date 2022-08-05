<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolsPage extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public ?array $createSchoolQueryString;
    public Collection $districts;
    public int $districtFilter = 0;
    public string $query = '';

    protected $queryString = [
        'districtFilter' => ['except' => null, 'as' => 'district'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    protected $listeners = ['districtSelected' => 'setDistrict'];

    public function mount()
    {
        $this->authorize('viewAny', School::class);
        $this->districts = District::with('schools')->get()->sortBy('name');
    }

    public function render()
    {
        $this->createSchoolQueryString = null;
        if ($this->districtFilter > 0) {
            $this->createSchoolQueryString = ['district' => $this->districtFilter];
            $schools = School::with('district', 'district.package')
                ->whereHas('district', function (Builder $query) {
                $query->where('id', $this->districtFilter);
            });
        }
        else if ($this->districtFilter < 0) {
            $schools = School::with('district', 'district.package')
                ->doesntHave('district');
        }
        else {
            $schools = School::with('district', 'district.package')
                ->where('id', '>', 0);
        }
        $schools = $schools->orderBy('name')
                       ->paginate(15);
        foreach ($schools as $school) {
            if (! $school->package) {
                if ($school->district->package) {
                    $school->packageText = "{$school->district->package->name} (Inherited)";
                }
                else {
                    'NO PACKAGE!';
                }
            }
            else
            {
                $school->packageText = $school->package->name;
            }
        }
            return view('livewire.admin.schools-page', ['schools' => $schools]);
        }
}
