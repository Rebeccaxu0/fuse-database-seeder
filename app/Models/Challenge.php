<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    /**
     * Get the levels.
     */
    public function levels()
    {
      return $this->hasMany(Level::class);
    }
}
