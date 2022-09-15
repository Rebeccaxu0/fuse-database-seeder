<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Models\Organization
 *
 * @property-read \App\Models\Package $package
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\OrganizationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 * @mixin \Eloquent
 */
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
