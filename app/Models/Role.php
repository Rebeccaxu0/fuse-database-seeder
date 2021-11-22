<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ROOT_ID              = 1;
    public const ADMIN_ID             = 2;
    public const REPORT_VIEWER_ID     = 3;
    public const CHALLENGE_AUTHOR_ID  = 4;
    public const SUPER_FACILITATOR_ID = 5;
    public const FACILITATOR_ID       = 6;
    public const STUDENT_ID           = 7;
    public const ANONYMOUS_STUDENT_ID = 8;

    /**
     * The users associated with this role.
     */
    public function users()
    {
      return $this->belongsToMany(User::class);
    }
}
