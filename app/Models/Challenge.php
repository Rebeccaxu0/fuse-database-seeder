<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challenge extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The challenges which list this Challenge as a prerequisite.
     */
    public function dependantChallenges()
    {
        return $this->hasMany(Challenge::class, 'prerequisite_challenge_id');
    }

    /**
     * The prerequisite challenge associated with this challenge.
     */
    public function prerequisiteChallenge()
    {
        return $this->belongsTo(Challenge::class, 'prerequisite_challenge_id');
    }

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

    public function isStartable(User $user)
    {
      return $this->prerequisiteChallenge
          ? $this->isCompleted($user)
          : true;
    }

    public function isCompleted(User $user)
    {
        $completed = false;
        foreach ($this->challengeVersions as $cv) {
          if ($user->hasCompletedLevel($cv->levels->last())) {
            $completed = true;
            break;
          }
        }
        return $completed;
    }
}
