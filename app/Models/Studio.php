<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * The students associated with this studio.
     */
    public function students()
    {
      return $this->users()->whereHas('roles', function(Builder $query) {
        $query->where('id', '=', Role::STUDENT_ID);
      });
    }

    /**
     * The facilitators associated with this studio's parent org (school).
     */
    public function facilitators()
    {
      return $this->users()->whereHas('roles', function(Builder $query) {
          $query->where('id', '=', Role::FACILITATOR_ID);
        });
    }

    /**
     * The super facilitators associated with this studio's grandparent org (district).
     */
    public function superFacilitators()
    {
      return $this->users()->whereHas('roles', function(Builder $query) {
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
    public function challengeVersions() {
      return $this->belongsToMany(ChallengeVersion::class);
    }
}
