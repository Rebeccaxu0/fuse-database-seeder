<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The challenges associated with this package.
     */
    public function challenges()
    {
      return $this->belongsToMany(Challenge::class);
    }

    /**
     * The districts associated with this package.
     */
    public function districts()
    {
      return $this->belongsToMany(District::class);
    }

    /**
     * The schools associated with this package.
     */
    public function schools()
    {
      return $this->belongsToMany(School::class);
    }

    /**
     * The studios associated with this package.
     */
    public function studios()
    {
      return $this->belongsToMany(Studio::class);
    }
}
