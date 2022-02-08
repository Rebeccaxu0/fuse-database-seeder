<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Organization
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The Package associated with this studio or the parent School/District.
     */
    public function deFactoPackage()
    {
        if ($this->package()->count() > 0) {
            return $this->package();
        }
        return $this->school->deFactoPackage();
    }

    /**
     * The users currently active in this studio.
     */
    public function actveUsers()
    {
        return $this->hasMany(User::class, 'active_studio');
    }

    /**
     * The students currently active in this studio.
     */
    public function activeStudents()
    {
      return $this->activeUsers()->doesntHave('roles');
    }

    /**
     * The students associated with this studio.
     */
    public function students()
    {
      return $this->users()->doesntHave('roles');
    }

    /**
     * The facilitators currently active in this studio.
     */
    public function activeFacilitators()
    {
        return $this->activeUsers()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::FACILITATOR_ID);
        });
    }

    /**
     * The facilitators associated with this studio's parent org (school).
     */
    public function facilitators()
    {
        return $this->users()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::FACILITATOR_ID);
        });
    }

    /**
     * The super facilitators currently active in this studio.
     */
    public function activeSuperFacilitators()
    {
        return $this->activeUsers()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::SUPER_FACILITATOR_ID);
        });
    }

    /**
     * The super facilitators associated with this studio's grandparent org (district).
     */
    public function superFacilitators()
    {
        return $this->users()->whereHas('roles', function (Builder $query) {
            $query->where('id', '=', Role::SUPER_FACILITATOR_ID);
        });
    }

    /**
     * The parent org (school) above this studio.
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * The grandparent org (district) above this studio.
     */
    public function district()
    {
        return $this->school()->first() ? $this->school()->first()->district() : null;
    }

    /**
     * The package associated with this district.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * The Challenges a student is allowed to view/start.
     * Always a subset of the challenges in the defacto package.
     */
    public function challengeVersions()
    {
        return $this->belongsToMany(ChallengeVersion::class);
    }

    /**
     * Alias of challengeVersions().
     */
    public function activeChallenges()
    {
        return $this->challengeVersions();
    }
}
