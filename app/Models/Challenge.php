<?php

namespace App\Models;

use App\Enums\ChallengeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Challenge
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int|null $prerequisite_challenge_id Challenge to complete before starting this one (optional)
 * @property int|null $d7_id
 * @property-read \Plank\Mediable\MediableCollection|\App\Models\ChallengeVersion[] $challengeVersions
 * @property-read int|null $challenge_versions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Challenge[] $dependantChallenges
 * @property-read int|null $dependant_challenges_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Package[] $packages
 * @property-read int|null $packages_count
 * @property-read Challenge|null $prerequisiteChallenge
 * @method static \Database\Factories\ChallengeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge newQuery()
 * @method static \Illuminate\Database\Query\Builder|Challenge onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereD7Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge wherePrerequisiteChallengeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Challenge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Challenge withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Challenge withoutTrashed()
 * @mixin \Eloquent
 */
class Challenge extends Model
{
    use HasFactory;
    // use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => ChallengeStatus::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'prerequisite_challenge_id',
    ];

    /**
     * The challenges which list this Challenge as a prerequisite.
     */
    public function dependantChallenges()
    {
        return $this->hasMany(Challenge::class, 'prerequisite_challenge_id');
    }

    /**
     * The prerequisite challenge associated with this challenge.
     */
    public function prerequisiteChallenge()
    {
        return $this->belongsTo(Challenge::class, 'prerequisite_challenge_id');
    }

    /**
     * The challenge versions associated with this challenge.
     */
    public function challengeVersions()
    {
        return $this->hasMany(ChallengeVersion::class);
    }

    /**
     * The packages that this challenge is included in.
     */
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public function isStartable(User $user)
    {
      return $this->prerequisiteChallenge
          ? $this->prerequisiteChallenge->isCompleted($user)
          : true;
    }

    public function isCompleted(User $user)
    {
        $completed = false;
        foreach ($this->challengeVersions as $cv) {
          if ($user->hasCompletedLevel($cv->levels->last())) {
            $completed = true;
            break;
          }
        }
        return $completed;
    }
}
