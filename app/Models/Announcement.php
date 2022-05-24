<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'url',
        'body',
        'start_at',
        'end_at',
    ];

    public function readers()
    {
        return $this->belongsToMany(User::class, 'announcement_seen', 'announcement_id', 'user_id');
    }
}
