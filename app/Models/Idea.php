<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    /**
     * Users who thought of or own this idea.
     */
    public function users()
    {
      return $this->team();
    }

    /**
     * Users who thought of or own this idea.
     */
    public function team()
    {
      return $this->morphToMany(User::class, 'teamable', 'teams');
    }

    /**
     * Challenge Version(s) that inspired this idea.
     */
    public function challengeVersions()
    {
      return $this->inspiration();
    }

    /**
     * Challenge Version(s) that inspired this idea.
     */
    public function inspiration()
    {
      return $this->belongsToMany(ChallengeVersion::class, 'idea_inspirations');
    }

    /**
     * Get the artifacts on this idea.
     */
    public function artifacts()
    {
      return $this->morphMany(Artifact::class, 'artifactable');
    }

}
