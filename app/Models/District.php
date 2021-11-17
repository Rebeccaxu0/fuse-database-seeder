<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class District extends Organization
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'salesforce_acct_id',
      'package_id'
    ];

    /**
     * The super facilitators associated with this district.
     */
    public function superFacilitators()
    {
      return $this->users()->whereHas('roles', function(Builder $query) {
        $query->where('name', '=', 'Super Facilitator');
      });
    }

    /**
     * The facilitators associated with all child schools.
     */
    public function facilitators()
    {
      $schools = $this->schools()->get()->pluck('id');
      return User::whereHas('schools', function(Builder $query) use ($schools) {
        $query->whereIn('id', $schools);
      })
        ->whereHas('roles', function(Builder $query) {
          $query->where('name', '=', 'Facilitator');
        });
    }

    /**
     * The students associated with all child studios of child schools.
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
}
