<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The challenges associated with this package.
     */
    public function challenges()
    {
      return $this->belongsToMany(Challenge::class);
    }
}
