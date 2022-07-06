<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;

class Artifact extends Model
{
    use HasFactory;
    use Mediable;
    use SoftDeletes;

    /**
     * The users that created this artifact.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The comments attached to this Artifact.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the parent level.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

