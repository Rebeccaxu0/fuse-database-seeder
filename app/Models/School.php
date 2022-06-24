<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class School extends Organization
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'package_id',
        'salesforce_acct_id',
        'partner_id',
        'district_id',
    ];

    /**
     * The Package associated with this school, or parent District.
     */
    public function deFactoPackage()
    {
        if ($this->assignedPackage() || ! $this->assignedDistrict()) {
            return $this->package();
        }
        return $this->district->package();
    }

    /**
     * The users associated with this school.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The facilitators associated with this school.
     */
    public function facilitators()
    {
        return $this->users()
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', '=', 'Facilitator');
            });
    }

    /**
     * The students associated with the child studios of this school.
     */
    public function students()
    {
        $studios = $this->studios()->get()->pluck('id');
        return User::whereHas('studios', function (Builder $query) use ($studios) {
            $query->whereIn('id', $studios);
        })
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', '=', 'Student');
            });
    }

    /**
     * The super facilitators associated with the parent district of this school.
     */
    public function superFacilitators()
    {
        $district = $this->district()->first();
        $superFacilitators = new Collection;
        if ($district) {
            $superfacilitators = User::whereHas('districts',
              function (Builder $query) use ($district) {
                  $query->where('id', '=', $district->id);
              })
              ->whereHas('roles', function (Builder $query) {
                  $query->where('name', '=', 'Super Facilitator');
              });
            }
        return $superFacilitators;
    }

    /**
     * The district above this school.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Cacheable function to determine if school belongs to a district.
     */
    public function assignedDistrict() : bool
    {
        return Cache::remember("s{$this->id}_has_district", 3600, fn () => (bool) $this->district );
    }

    /**
     * The studios associated with this school.
     */
    public function studios()
    {
        return $this->hasMany(Studio::class);
    }

    /**
     * The partner associated with this school.
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * The package associated with this district.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Cacheable function to determine if school is directly assigned a package.
     */
    public function assignedPackage() : bool
    {
        return Cache::remember("school_{$this->id}_has_package", 3600, fn () => (bool) $this->package );
    }

    /**
     * The grade levels associated with this school.
     */
    public function gradelevels()
    {
        return $this->belongsToMany(GradeLevel::class);
    }

    /**
     * Add a parent organization (District) to a School.
     *
     * @param int[] $district_ids
     *  List of district ids (should just be one).
     */
    public function addDistrict(array $district_ids)
    {
        $id = $district_ids[0];
        $district = District::find($id);
        $district->schools()->save($this);
        $district->save();
        $this->save();
    }


    /**
     * Add grade levels to a District.
     *
     * @param int[] $gradelevels
     *  List of grade level ids.
     */
    public function addGradeLevels(array $gradelevels)
    {
        foreach ($gradelevels as $id) {
            $gradelevel = GradeLevel::find($id);
            if (! (in_array($gradelevel->id, $this->gradelevels->pluck('id')->toArray()))) {
                $gradelevel->schools()->associate($this);
                $gradelevel->save();
            }
        }
    }

    /**
     * Create studios and add them to a School.
     *
     * @param int[] $studios_to_create
     *  List of studio ids.
     */
    public function createStudios(array $studios_to_create)
    {
        foreach ($studios_to_create as $name) {
            $studio = new Studio(['name' => $name]);
            $studio->setNewStudioCode();
            $studio->package()->associate($this->package);
            $studio->school()->associate($this);
            $studio->save();
        }

        // Clear deFactoStudios cache for every direct member (non-student)
        // in this school and district.
        foreach ($this->users as $user) {
            Cache::forget("u{$user->id}_studios");
        }
        foreach ($this->district->users as $user) {
            Cache::forget("u{$user->id}_studios");
        }
    }

    /**
     * Add studios to a School.
     *
     * @param int[] $studios_to_add
     *  List of studio ids.
     */
    public function addStudios(array $studios_to_add)
    {
        foreach ($studios_to_add as $id) {
            $studio = Studio::find($id);
            if (! (in_array($studio->id, $this->studios->pluck('id')->toArray()))) {
                $studio->school()->associate($this);
                $studio->save();
            }
        }
    }

    /**
     * Remove studios from a School.
     *
     * @param int[] $studios_to_remove
     *  List of studio ids.
     */
    public function removeStudios(array $studios_to_remove)
    {
        foreach ($this->studios as $studio) {
            if (in_array($studio->id, $studios_to_remove)) {
                $studio->school()->dissociate();
                $studio->save();
            }
        }
    }

    /**
     * Add facilitators to a School.
     *
     * @param int[] $facilitatorId
     *  List of facilitator ids.
     */
    public function addFacilitators(array $facilitatorId)
    {
        foreach ($facilitatorId as $id) {
            $facilitator = User::find($id);
            if (! (in_array($this->id, $facilitator->schools->pluck('id')->toArray()))) {
                $facilitator->schools()->attach($this);
            }
            if (! $facilitator->isFacilitator()) {
                $facilitator->roles()->attach(Role::FACILITATOR_ID);
                Cache::forget("u{$facilitator->id}_has_role_" . Role::FACILITATOR_ID);
            }
        }
    }

    /**
     * Remove facilitators from a School.
     *
     * @param int[] $facilitators
     *  List of facilitator ids.
     */
    public function removeFacilitators(array $facilitatorIds)
    {
        foreach ($this->facilitators as $facilitator) {
            if (in_array($facilitator->id, $facilitatorIds)) {
                $facilitator->schools()->detach($this);
                $facilitator->save();
                // TODO: emit event to say a user associations have changed.
                if ($facilitator->schools->count() == 0) {
                    $facilitator->roles()->detach(Role::FACILITATOR_ID);
                    Cache::forget("u{$facilitator->id}_has_role_" . Role::FACILITATOR_ID);
                }
            }
        }
    }
}
