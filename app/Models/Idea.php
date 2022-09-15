<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Idea
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $body
 * @property int|null $copied_from_level
 * @property int|null $d7_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Artifact[] $artifacts
 * @property-read int|null $artifacts_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $inspiration
 * @property-read int|null $inspiration_count
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\Level[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Start[] $starts
 * @property-read int|null $starts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\IdeaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea newQuery()
 * @method static \Illuminate\Database\Query\Builder|Idea onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea query()
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereCopiedFromLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Idea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Idea withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Idea withoutTrashed()
 * @mixin \Eloquent
 */
class Idea extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Users who thought of or own this idea.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the start on this idea.
     */
    public function starts()
    {
        return $this->hasMany(Start::class);
    }

    /**
     * Get the level on this idea.
     */
    public function levels()
    {
        return $this->morphMany(Level::class, 'levelable');
    }

    /**
     * Challenge Version(s) that inspired this idea.
     */
    public function challengeVersions()
    {
        return $this->inspiration();
    }

    /**
     * Challenge Version(s) that inspired this idea.
     */
    public function inspiration()
    {
        return $this->belongsToMany(ChallengeVersion::class, 'idea_inspirations');
    }

    /**
     * Get the artifacts on this idea.
     */
    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }

    /**
     * Render inspiration Challenge names to a string.
     * N.B. This is likely not very localization-friendly.
     */
    public function inspirationListToStr()
    {
        $inspiration = $this->inspiration->map(function ($challengeVersion, $key) {
            return $challengeVersion->challenge->name;
        })->join(', ', ' and ');

        return $inspiration
            ? $inspiration
            : __('none');
    }

    /**
     * Render users (teammates) names to a string.
     * N.B. This is likely not very localization-friendly.
     */
    public function usersListToStr()
    {
        return $this->users->map(function ($user, $key) {
            return $user->full_name;
        })->join(', ', ' and ');
    }
}

