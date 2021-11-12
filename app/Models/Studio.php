<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Studio extends Organization
{
    use HasFactory;

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
        $query->where('name', '=', 'Student');
      });
    }

    /**
     * The facilitators associated with this studio's parent org (school).
     */
    public function facilitators()
    {
      return User::whereHas('schools', function(Builder $query) {
        $query->where('id', '=', $this->school()->first()->id);
      })
        ->whereHas('roles', function(Builder $query) {
          $query->where('name', '=', 'Facilitator');
        });
    }

    /**
     * The super facilitators associated with this studio's grandparent org (district).
     */
    public function superFacilitators()
    {
      return User::whereHas('districts', function(Builder $query) {
        $query->where('id', '=', $this->school()->first()->district()->first()->id);
      })
        ->whereHas('roles', function(Builder $query) {
          $query->where('name', '=', 'Super Facilitator');
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
      return $this->school()->first()->district();
    }

    /**
     * The package associated with this district.
     */
    public function package()
    {
      return $this->belongsTo(Package::class);
    }
}
