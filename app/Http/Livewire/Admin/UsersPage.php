<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\District;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UsersPage extends Component
{
    use WithPagination;

    public Collection $districts;
    public District $district;
    public int $districtFilter = 0;
    public string $userSearch = '';
    public bool $status = true;
    public bool $onlyOnline = false;
    public string $rolesFilter = 'all';
    public string $query = '';

    protected $listeners = ['toggleOnline'];

    public function mount()
    {
        $this->districts = District::all();
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

      if ($this->districtFilter) {
          $this->district = $this->districts->find($this->districtFilter);
          $users = $users->where(function ($outerQuery) {
              $outerQuery
                  ->orWhereHas('districts', function (Builder $innerQuery) {
                      $innerQuery->where('id', $this->districtFilter);
                  })
                  ->orWhereHas('schools', function (Builder $innerQuery) {
                      $innerQuery->whereIn('id', $this->district->schools->pluck('id'));
                  })
                  ->orWhereHas('studios', function (Builder $innerQuery) {
                      $innerQuery->whereIn('id', $this->district->studios->pluck('id'));
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
