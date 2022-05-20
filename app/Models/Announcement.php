<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public function readers()
    {
        return $this->belongsToMany(User::class, 'announcement_seen', 'announcement_id', 'user_id');
    }
}
