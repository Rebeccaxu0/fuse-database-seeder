<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    /**
     * The Package associated with this studio.
     */
    public function package()
    {
      return $this->has(Package::class);
    }

    /**
     * The users associated with this studio.
     */
    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    /**
     * The students associated with this studio.
     */
    public function students()
    {
      return $this->belongsToMany(User::class)->whereHas('roles', function($q) {
        $q->where('name', '=', 'Student');
      });
    }

    /**
     * The school above with this studio.
     */
    public function school()
    {
      return $this->belongsTo(School::class);
    }
}
