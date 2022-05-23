<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'artifact_id',
        'body',
        'user_id',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readers()
    {
        return $this->belongsToMany(User::class, 'comment_seen', 'comment_id', 'user_id');
    }
}
