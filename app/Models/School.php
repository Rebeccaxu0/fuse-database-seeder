<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    /**
     * The Package associated with this school.
     */
    public function package()
    {
      return $this->has(Package::class);
    }

    /**
     * The users associated with this school.
     */
    public function users()
    {
      return $this->belongsToMany(User::class);
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
}
