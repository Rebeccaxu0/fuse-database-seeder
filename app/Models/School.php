<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class School extends Organization
{
    use HasFactory;

    /**
     * The Package associated with this school, or parent District.
     */
    public function deFactoPackage()
    {
      if ($this->package()->count() > 0) {
        return $this->package();
      }
      return $this->district()->first()->package();
    }

    /**
     * The facilitators associated with this school.
     */
    public function facilitators()
    {
      return $this->users()
                  ->whereHas('roles', function(Builder $query) {
                    $query->where('name', '=', 'Facilitator');
                  });
    }

    /**
     * The students associated with the child studios of this school.
     */
    public function students()
    {
      $studios = $this->studios()->get()->pluck('id');
      return User::whereHas('studios', function(Builder $query) use ($studios) {
        $query->whereIn('id', $studios);
      })
        ->whereHas('roles', function(Builder $query) {
          $query->where('name', '=', 'Student');
        });
    }

    /**
     * The super facilitators associated with the parent district of this school.
     */
    public function superFacilicators()
    {
      $district = $this->district()->first();
      return User::whereHas('districts', function(Builder $query) use ($district) {
        $query->where('id', '=', $district->id);
      })
        ->whereHas('roles', function(Builder $query) {
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
}
