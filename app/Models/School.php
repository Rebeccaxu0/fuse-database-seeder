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
    ];

    /**
     * The Package associated with this school, or parent District.
     */
    public function deFactoPackage()
    {
        if ($this->package()->count() > 0 || ! $this->district) {
            return $this->package();
        }
        return $this->district->package();
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
            $studio->school()->associate($this);
            $studio->save();
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
     * Add superfacilitators to a School.
     *
     * @param int[] $super_facilitator_ids
     *  List of super facilitator ids.
     */
    public function addSuperFacilitators(array $super_facilitator_ids)
    {
        $district = $this->district->id;
        foreach ($super_facilitator_ids as $id) {
            $sfuser = User::find($id);
            if (! (in_array($this->id, $sfuser->districts->pluck('id')->toArray()))) {
                $sfuser->districts()->attach($district);
            }
            if (! $sfuser->isSuperFacilitator()) {
                $sfuser->roles()->attach(Role::SUPER_FACILITATOR_ID);
                Cache::forget("u{$sfuser->id}_has_role_" . Role::SUPER_FACILITATOR_ID);
            }
        }
    }

    /**
     * Remove superfacilitators from a School.
     *
     * @param int[] $super_facilitators
     *  List of super facilitator ids.
     */
    public function removeSuperFacilitators(array $super_facilitator_ids)
    {
        $district = $this->district->id;
        foreach ($this->superFacilitators as $sf) {
            if (in_array($sf->id, $super_facilitator_ids)) {
                $sf->districts()->detach($district);
                $sf->save();
                // TODO: emit event to say a user associations have changed.
                // event listener: “Oh you’re a super facilitator, but you’re not a member of district anymore?
                // Then I guess you’re not a super facilitator anymore”
            }
        }
    }
}

