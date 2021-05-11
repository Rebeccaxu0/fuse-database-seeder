<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * Get the levels.
     */
    public function challenge()
    {
      return $this->belongsTo(Challenge::class);
    }
}
