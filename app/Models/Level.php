<?php

namespace App\Models;

use App\Exceptions\LevelException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
Use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['stuff_you_need'];

    // Level number (level order) can only be set via the parent Challenge's
    // `reorder_levels()` method.
    protected $guarded = ['level_number'];

    /**
     * Get the associated ChallengeVersion.
     */
    public function challengeVersion()
    {
        return $this->belongsTo(ChallengeVersion::class);
    }

    /**
     * Get the artifacts on this level.
     */
    public function artifacts()
    {
        return $this->morphMany(Artifact::class, 'artifactable');
    }

    public function setChallengeVersionIDAttribute($value)
    {
        $this->attributes['challenge_version_id'] = $value;
        $this->level_number = null;
    }

    public function setLevelNumberAttribute($value)
    {
        if (! is_null($value)) {
            $e = 'Cannot set the level order number from the level directly. '
                 . 'See App\Models\ChallengeVersion::setLevelsOrder()';
            throw new LevelException($e);
        } else {
            $this->attributes['level_number'] = null;
        }
    }

    public function isStarted(User $user): bool
    {
        return $user->startedLevel($this);
    }
}
