<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class SchoolsPage extends Component
{
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
        $this->districts = District::with('schools')->get()->sortBy('name');
    }

    public function render()
    {
        $this->createSchoolQueryString = null;
        if ($this->districtFilter > 0) {
            $this->createSchoolQueryString = ['district' => $this->districtFilter];
            $schools = School::whereHas('district', function (Builder $query) {
                $query->where('id', $this->districtFilter);
            });
        }
        else if ($this->districtFilter < 0) {
            $schools = School::doesntHave('district');
        }
        else {
            $schools = School::where('id', '>', 0);
        }
        $schools = $schools->orderBy('name')
                       ->paginate(15);
        return view('livewire.admin.schools-page', ['schools' => $schools]);
    }
}
