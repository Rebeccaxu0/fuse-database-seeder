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
    public function team()
    {
      return $this->morphToMany(User::class, 'teamable', 'teams');
    }

    /**
     * Get the artifacts on this idea.
     */
    public function artifacts()
    {
      return $this->morphMany(Artifact::class, 'artifactable');
    }

}
