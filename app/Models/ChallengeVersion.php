<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeVersion extends Model
{
    use HasFactory;

    /**
     * The challenge that owns this challenge version.
     */
    public function challenge()
    {
      return $this->belongsTo(Challenge::class);
    }

    /**
     * The levels associated with this challenge.
     */
    public function levels()
    {
      return $this->hasMany(Level::class);
    }
}
