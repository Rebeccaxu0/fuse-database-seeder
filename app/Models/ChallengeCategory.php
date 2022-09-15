<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ChallengeCategory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string $description
 * @property int $disapproved
 * @property int|null $d7_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $challengeVersions
 * @property-read int|null $challenge_versions_count
 * @method static \Database\Factories\ChallengeCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|ChallengeCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereDisapproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChallengeCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ChallengeCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ChallengeCategory withoutTrashed()
 * @mixin \Eloquent
 */
class ChallengeCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Challenges tagged with with category.
     */
    public function challengeVersions()
    {
        return $this->hasMany(ChallengeVersion::class);
    }
}
