<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Media as MediableMedia;

class Media extends MediableMedia
{
    use HasFactory;
    use SoftDeletes;
}
