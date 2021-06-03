<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    use HasFactory;

    /**
     * The users that created this artifact.
     */
    public function users()
    {
      return $this->team();
    }

    public function team()
    {
      return $this->morphToMany(User::class, 'teamable', 'teams');
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    /**
     * Get the parent artifactable model (level or idea).
     */
    public function artifactable()
    {
      return $this->morphTo();
    }
}
