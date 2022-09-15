<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

/**
 * App\Models\District
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property int $license_status Active License
 * @property int|null $package_id
 * @property string|null $salesforce_acct_id
 * @property int|null $l_t_i_platform_id
 * @property int|null $d7_id
 * @property-read \App\Models\Package|null $package
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\School[] $schools
 * @property-read int|null $schools_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Studio[] $studios
 * @property-read int|null $studios_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\DistrictFactory factory(...$parameters)
 * @method static Builder|District newModelQuery()
 * @method static Builder|District newQuery()
 * @method static \Illuminate\Database\Query\Builder|District onlyTrashed()
 * @method static Builder|District query()
 * @method static Builder|District whereCreatedAt($value)
 * @method static Builder|District whereD7Id($value)
 * @method static Builder|District whereDeletedAt($value)
 * @method static Builder|District whereId($value)
 * @method static Builder|District whereLTIPlatformId($value)
 * @method static Builder|District whereLicenseStatus($value)
 * @method static Builder|District whereName($value)
 * @method static Builder|District wherePackageId($value)
 * @method static Builder|District whereSalesforceAcctId($value)
 * @method static Builder|District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|District withTrashed()
 * @method static \Illuminate\Database\Query\Builder|District withoutTrashed()
 * @mixin \Eloquent
 */
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
            ->whereDoesntHave('roles');
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
                    ->put("u{$id}_has_role_" . Role::SUPER_FACILITATOR_ID, true, 1800);
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
                        ->put("u{$sf->id}_has_role_" . Role::SUPER_FACILITATOR_ID, false, 1800);
                }
            }
        }
    }
}
