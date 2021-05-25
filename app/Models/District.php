<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * The Package associated with this district.
     */
    public function package()
    {
      return $this->has(Package::class);
    }

    /**
     * The users associated with this district.
     */
    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    /**
     * The superfacilitators associated with this school.
     */
    public function superFacilitators()
    {
      return $this->belongsToMany(User::class)->whereHas('roles', function($q) {
        $q->where('name', '=', 'Super Facilitator');
      });
    }

    /**
     * The Schools associated with this district.
     */
    public function schools()
    {
      return $this->hasMany(School::class);
    }
}
