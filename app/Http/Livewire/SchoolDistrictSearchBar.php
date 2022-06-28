<?php

namespace App\Http\Livewire;

use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SchoolDistrictSearchBar extends Component
{
    public $query;

    public function selectSchool($id)
    {
        $this->emitUp('schoolSelected', $id);
        $this->query = '';
    }

    public function updatedQuery()
    {
        $this->schools = School::where('name', 'like', "%{$this->query}%")
            ->orWhereHas(
                'district',
                function (Builder $query) {
                    $query->where('name', 'like', "%{$this->query}%");
                }
            )
            ->with('district')
            ->limit(10)
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.school-district-search-bar');
    }
}
