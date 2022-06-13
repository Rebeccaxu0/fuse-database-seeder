<?php

namespace App\Http\Livewire\Admin;

use App\Models\District;
use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UsersPage extends Component
{
    use WithPagination;

    public Collection $districts;
    public Collection $schools;
    public int $districtFilter = 0;
    public int $schoolFilter = 0;
    public string $userSearch = '';
    public bool $status = true;
    public bool $onlyOnline = false;
    public string $rolesFilter = 'all';
    public string $query = '';

    protected $listeners = ['toggleOnline'];
    protected $queryString = [
      'districtFilter' => ['except' => 0, 'as' => 'district'],
      'schoolFilter' => ['except' => 0, 'as' => 'school'],
      'onlyOnline' => ['except' => false, 'as' => 'online'],
      'page' => ['except' => 1, 'as' => 'p'],
      'rolesFilter' => ['except' => 'all', 'as' => 'user_type'],
      'userSearch' => ['except' => '', 'as' => 's'],
    ];

    public function mount()
    {
        $this->districts = District::with('schools')->get()->sortBy('name');
        if ($this->districtFilter) {
            $this->district = $this->districts->find($this->districtFilter);
            $this->schools = $this->district->schools->sortBy('name');
        }
        else {
            $this->schools = School::all()->sortBy('name');
        }
    }

    public function toggleOnline() {
        $this->onlyOnline = ! $this->onlyOnline;
    }

    public function updatedUserSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
      $users = User::where('status', (int) $this->status);
      if (strlen($this->userSearch) > 2) {
        $users = $users->where(function ($query) {
          $query->orWhere('name', 'like', "%{$this->userSearch}%")
              ->orWhere('full_name', 'like', "%{$this->userSearch}%")
              ->orWhere('email', 'like', "%{$this->userSearch}%");
        });
      }

      switch ($this->rolesFilter) {
          case 'students':
              $users = $users->whereDoesntHave('roles');
              break;

          case 'facs':
              $users = $users->whereHas('roles', function (Builder $query) {
                  $query->whereIn('id', [Role::PRE_FACILITATOR_ID, Role::PRE_SUPER_FACILITATOR_ID, Role::FACILITATOR_ID, Role::SUPER_FACILITATOR_ID]);
              });
              break;

          case 'staff':
              $users = $users->whereHas('roles', function (Builder $query) {
                  $query->whereIn('id', [Role::ROOT_ID, Role::ADMIN_ID, Role::REPORT_VIEWER_ID, Role::CHALLENGE_AUTHOR_ID]);
              });
              break;

          default:
      }

      if ($this->schoolFilter) {
          $school = School::find($this->schoolFilter);
          $users = $users->where(function ($outerQuery) use ($school) {
              $outerQuery
                  ->orWhereHas('schools', function (Builder $innerQuery) {
                      $innerQuery->where('id', $this->schoolFilter);
                  })
                  ->orWhereHas('studios', function (Builder $innerQuery) use ($school) {
                      $innerQuery->whereIn('id', $school->studios->pluck('id'));
                  });
          });
      }
      else if ($this->districtFilter) {
          $district = District::find($this->districtFilter);
          $users = $users->where(function ($outerQuery) use ($district) {
              $outerQuery
                  ->orWhereHas('districts', function (Builder $innerQuery) {
                      $innerQuery->where('id', $this->districtFilter);
                  })
                  ->orWhereHas('schools', function (Builder $innerQuery) use ($district) {
                      $innerQuery->whereIn('id', $district->schools->pluck('id'));
                  })
                  ->orWhereHas('studios', function (Builder $innerQuery) use ($district) {
                      $innerQuery->whereIn('id', $district->studios->pluck('id'));
                  });
          });
      }

      if ($this->onlyOnline) {
        $users = $users->where('last_access', '>', Carbon::now()->subMinutes(5)->toDateTimeString());
      }

      $this->query = $users->toSql();
      $users = $users->orderBy('full_name')
                     ->paginate(15);

      return view('livewire.admin.users-page', ['users' => $users]);
    }
}
