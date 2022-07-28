<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class District extends Organization
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
        'license_status',
    ];

    /**
     * The users associated with this district.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The super facilitators associated with this district.
     */
    public function superFacilitators()
    {
        return $this->users()->whereHas('roles', function (Builder $query) {
            $query->where('name', '=', 'Super Facilitator');
        });
    }

    /**
     * The facilitators associated with all child schools.
     */
    public function facilitators()
    {
        $schools = $this->schools()->get()->pluck('id');
        return User::whereHas('schools', function (Builder $query) use ($schools) {
            $query->whereIn('id', $schools);
        })
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', '=', 'Facilitator');
            });
    }

    /**
     * The students associated with all child studios of child schools.
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
     * The Schools associated with this district.
     */
    public function schools()
    {
        return $this->hasMany(School::class);
    }

    /**
     * The Studios associated with this district.
     */
    public function studios()
    {
        return $this->hasManyThrough(Studio::class, School::class);
    }

    /**
     * The package associated with this district.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Add schools to a District.
     *
     * @param int[] $schools_to_add
     *  List of school ids.
     */
    public function addSchools(array $schools_to_add)
    {
        foreach ($schools_to_add as $id) {
            $school = School::find($id);
            if (! (in_array($school->id, $this->schools->pluck('id')->toArray()))) {
                $school->district()->associate($this);
                $school->save();
            }
        }
    }

    /**
     * Remove schools from a District.
     *
     * @param int[] $schools_to_remove
     *  List of school ids.
     */
    public function removeSchools(array $schools_to_remove)
    {
        foreach ($this->schools as $school) {
            if (in_array($school->id, $schools_to_remove)) {
                $school->district()->dissociate();
                $school->save();
            }
        }
    }

    /**
     * Add superfacilitators to a District.
     *
     * @param int[] $super_facilitator_ids
     *  List of super facilitator ids.
     */
    public function addSuperFacilitators(array $super_facilitator_ids)
    {
        foreach ($super_facilitator_ids as $id) {
            $sfuser = User::find($id);
            if (! (in_array($this->id, $sfuser->districts->pluck('id')->toArray()))) {
                $sfuser->districts()->attach($this);
                Cache::forget("u{$id}_studios");
            }
            if (! $sfuser->isSuperFacilitator()) {
                $sfuser->roles()->attach(Role::SUPER_FACILITATOR_ID);
                Cache::tags(["u{$id}_roles"])
                    ->forever("u{$id}_has_role_" . Role::SUPER_FACILITATOR_ID, true);
            }
        }
    }

    /**
     * Remove superfacilitators from a District.
     *
     * @param int[] $super_facilitators
     *  List of super facilitator ids.
     */
    public function removeSuperFacilitators(array $super_facilitator_ids)
    {
        foreach ($this->superFacilitators as $sf) {
            if (in_array($sf->id, $super_facilitator_ids)) {
                $sf->districts()->detach($this);
                Cache::forget("u{$sf->id}_studios");
                $sf->fresh();
                if ($sf->districts->count() == 0) {
                    $sf->roles()->detach(Role::SUPER_FACILITATOR_ID);
                    Cache::tags(["u{$sf->id}_roles"])
                        ->forever("u{$sf->id}_has_role_" . Role::SUPER_FACILITATOR_ID, false);
                }
            }
        }
    }
}
