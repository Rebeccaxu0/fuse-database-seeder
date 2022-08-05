<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'start_at' => 'datetime:Y-m-d',
        'end_at' => 'datetime:Y-m-d',
    ];

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
