<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Organization extends Model
{
    use HasFactory;
    use Searchable;

    #[SearchUsingFullText('name')]
    /**
      * Laravel Scout fields for search.
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * The Package associated with this organization.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * The users associated with this studio.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
