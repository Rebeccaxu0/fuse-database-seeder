<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeCategory extends Model
{
    use HasFactory;

    /**
     * Challenges tagged with with category.
     */
    public function challenge_versions()
    {
      return $this->hasMany(ChallengeVersion::class);
    }
}
