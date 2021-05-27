<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    /**
     * Get the artifacts on this idea.
     */
    public function artifacts()
    {
      return $this->morphMany(Artifact::class, 'artifactable');
    }

}
