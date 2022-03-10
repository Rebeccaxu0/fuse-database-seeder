<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Start extends Model
{
    use HasFactory;

    /**
     * The user that created this start.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent startable model (level or idea).
     */
    public function startable()
    {
        return $this->morphTo();
    }
}
