<?php

namespace App\Http\Livewire;

use App\Models\School;
use Livewire\Component;

class SchoolSearchBar extends Component
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
        ->limit(10)
        ->get();
    }

    public function render()
    {
        return view('livewire.school-search-bar');
    }
}
