<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Start extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'level_id',
        'user_id',
    ];

    /**
     * The user that created this start.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the associated level.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

