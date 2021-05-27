<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The Package associated with this organization.
     */
    public function package()
    {
      return $this->belongsTo(Package::class);
    }

    /**
     * The users associated with this studio.
     */
    public function users()
    {
      return $this->belongsToMany(User::class);
    }

}
