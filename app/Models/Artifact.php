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
      return $this->belongsToMany(User::class, 'teams');
    }

    /**
     * The associated level.
     */
    public function level()
    {
      return $this->belongsTo(Level::class);
    }
}
