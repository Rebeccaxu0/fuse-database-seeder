<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Idea extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Users who thought of or own this idea.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the start on this idea.
     */
    public function starts()
    {
        return $this->hasMany(Start::class);
    }

    /**
     * Get the level on this idea.
     */
    public function levels()
    {
        return $this->morphMany(Level::class, 'levelable');
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
        return $this->hasMany(Artifact::class);
    }
}
