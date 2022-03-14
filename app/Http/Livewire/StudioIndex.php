<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\School;
use App\Models\Studio;
use Livewire\Component;

class StudioIndex extends Component

{
    public School $school;
    public ?int $ider = null;

    protected $queryString = [
        'ider' => ['except' => null, 'as' => 'id'],
    ];

    protected $listeners = ['dsSelected' => 'setDs'];

    public function mount()
    {
        if ($this->ider) {
            $this->setDs($this->ider);
        }
        else {
            $this->setDs(District::all()->first()->schools()->first()->id);
        }
    }

    public function setDs(int $school_id)
    {
        $this->school = School::find($school_id);
        $this->id = $school_id;
    }

    public function render()
    {
        return view('livewire.studio-index');
    }
}
