<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChallengeCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Challenges tagged with with category.
     */
    public function challengeVersions()
    {
      return $this->hasMany(ChallengeVersion::class);
    }
}
