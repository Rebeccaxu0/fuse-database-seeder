<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    /**
     * The challenge versions associated with this challenge.
     */
    public function challengeVersions()
    {
      return $this->hasMany(ChallengeVersion::class);
    }

    /**
     * The packages that this challenge is included in.
     */
    public function packages()
    {
      return $this->belongsToMany(Package::class);
    }
}
