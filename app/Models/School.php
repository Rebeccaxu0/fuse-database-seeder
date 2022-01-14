<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if ($this->package()->count() > 0) {
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
        return User::whereHas('districts', function (Builder $query) use ($district) {
            $query->where('id', '=', $district->id);
        })
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', '=', 'Super Facilitator');
            });
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


    /*
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
}
